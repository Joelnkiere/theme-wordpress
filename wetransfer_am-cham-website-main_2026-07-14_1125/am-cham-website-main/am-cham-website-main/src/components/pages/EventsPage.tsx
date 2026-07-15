import { useEffect, useRef, useState } from 'react';
import { Calendar, MapPin, Clock, Users } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { LoadingSpinner } from '@/components/ui/loading-spinner';
import { BaseCrudService } from '@/integrations';
import { Events } from '@/entities';
import Header from '@/components/Header';
import Footer from '@/components/Footer';

const AnimatedElement: React.FC<{children: React.ReactNode; className?: string; delay?: number}> = ({ children, className = '', delay = 0 }) => {
  const ref = useRef<HTMLDivElement>(null);
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const el = ref.current;
    if (!el) return;
    
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setTimeout(() => setIsVisible(true), delay);
          observer.unobserve(el);
        }
      },
      { threshold: 0.1 }
    );
    
    observer.observe(el);
    return () => observer.disconnect();
  }, [delay]);

  return (
    <div 
      ref={ref} 
      className={`transition-all duration-700 ${
        isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'
      } ${className}`}
    >
      {children}
    </div>
  );
};

export default function EventsPage() {
  const [events, setEvents] = useState<Events[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [hasNext, setHasNext] = useState(false);
  const [skip, setSkip] = useState(0);
  const [eventTypeFilter, setEventTypeFilter] = useState<string>('all');
  const [statusFilter, setStatusFilter] = useState<'all' | 'upcoming' | 'past'>('all');

  useEffect(() => {
    loadEvents();
  }, [skip]);

  const loadEvents = async () => {
    try {
      const result = await BaseCrudService.getAll<Events>('events', [], { limit: 9, skip });
      setEvents(prev => skip === 0 ? result.items : [...prev, ...result.items]);
      setHasNext(result.hasNext);
    } catch (error) {
      console.error('Error loading events:', error);
    } finally {
      setIsLoading(false);
    }
  };

  const loadMore = () => {
    setSkip(prev => prev + 9);
  };

  const isEventUpcoming = (eventDate: Date | string | undefined): boolean => {
    if (!eventDate) return true;
    const eventTime = new Date(eventDate).getTime();
    const now = new Date().getTime();
    return eventTime >= now;
  };

  const filteredEvents = events.filter(event => {
    const matchesEventType = eventTypeFilter === 'all' 
      ? true 
      : event.eventType?.toLowerCase() === eventTypeFilter.toLowerCase();
    
    const isUpcoming = isEventUpcoming(event.eventDateTime);
    const matchesStatus = statusFilter === 'all' 
      ? true 
      : (statusFilter === 'upcoming' ? isUpcoming : !isUpcoming);
    
    return matchesEventType && matchesStatus;
  });

  const upcomingEvents = filteredEvents.filter(e => isEventUpcoming(e.eventDateTime));
  const pastEvents = filteredEvents.filter(e => !isEventUpcoming(e.eventDateTime));

  const renderEventCard = (event: Events, index: number) => (
    <AnimatedElement key={event._id} delay={index * 50}>
      <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group">
        <CardContent className="p-6">
          {/* Event Type Badge */}
          {event.eventType && (
            <div className="mb-4">
              <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase">
                {event.eventType}
              </span>
            </div>
          )}

          {/* Event Date */}
          <div className="flex items-center space-x-2 mb-4">
            <Calendar size={18} className="text-muted-foreground" />
            <span className="font-paragraph text-sm text-muted-foreground">
              {event.eventDateTime 
                ? new Date(event.eventDateTime).toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                  })
                : 'Date TBD'}
            </span>
          </div>

          {/* Event Title */}
          <h3 className="font-heading text-xl font-bold text-foreground mb-3 group-hover:text-link transition-colors">
            {event.eventTitle}
          </h3>

          {/* Event Agenda */}
          <p className="font-paragraph text-muted-foreground text-sm leading-relaxed mb-4 line-clamp-3">
            {event.agenda}
          </p>

          {/* Event Topic */}
          {event.topic && (
            <div className="flex items-center space-x-2 mb-4">
              <Users size={16} className="text-muted-foreground" />
              <span className="font-paragraph text-xs text-muted-foreground">
                Topic: {event.topic}
              </span>
            </div>
          )}

          {/* Registration Link */}
          {event.registrationLink && (
            <Button 
              asChild
              className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
            >
              <a href={event.registrationLink} target="_blank" rel="noopener noreferrer">
                Register Now
              </a>
            </Button>
          )}
        </CardContent>
      </Card>
    </AnimatedElement>
  );

  return (
    <div className="min-h-screen bg-background">
      <Header />

      {/* Hero Section */}
      <section className="relative py-24 bg-gradient-to-br from-foreground via-foreground/95 to-foreground overflow-hidden">
        <div className="absolute inset-0 opacity-10">
          <div className="absolute inset-0" style={{
            backgroundImage: 'radial-gradient(circle, rgba(199,210,233,0.3) 1px, transparent 1px)',
            backgroundSize: '30px 30px'
          }} />
        </div>
        
        <div className="container mx-auto px-4 relative z-10">
          <AnimatedElement>
            <div className="max-w-4xl mx-auto text-center">
              <p className="font-paragraph text-primary text-sm uppercase tracking-wide mb-4">Events & Networking</p>
              <h1 className="font-heading text-5xl md:text-6xl font-bold text-primary mb-6">
                Connect, Learn, Grow
              </h1>
              <p className="font-paragraph text-primary/90 text-lg leading-relaxed">
                Join our exclusive networking sessions, policy roundtables, and business forums designed to foster collaboration and drive business success.
              </p>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Filter Section */}
      <section className="py-12 bg-muted/30">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="space-y-6">
              {/* Event Type Filters */}
              <div>
                <p className="font-paragraph text-sm font-semibold text-foreground mb-3 uppercase tracking-wide">Event Type</p>
                <div className="flex flex-wrap gap-3">
                  <Button
                    onClick={() => setEventTypeFilter('all')}
                    variant={eventTypeFilter === 'all' ? 'default' : 'outline'}
                    className={eventTypeFilter === 'all' ? 'bg-accent text-accent-foreground' : 'border-border text-foreground hover:bg-muted'}
                  >
                    All Types
                  </Button>
                  <Button
                    onClick={() => setEventTypeFilter('webinar')}
                    variant={eventTypeFilter === 'webinar' ? 'default' : 'outline'}
                    className={eventTypeFilter === 'webinar' ? 'bg-accent text-accent-foreground' : 'border-border text-foreground hover:bg-muted'}
                  >
                    Webinars
                  </Button>
                  <Button
                    onClick={() => setEventTypeFilter('networking')}
                    variant={eventTypeFilter === 'networking' ? 'default' : 'outline'}
                    className={eventTypeFilter === 'networking' ? 'bg-accent text-accent-foreground' : 'border-border text-foreground hover:bg-muted'}
                  >
                    Networking
                  </Button>
                  <Button
                    onClick={() => setEventTypeFilter('forum')}
                    variant={eventTypeFilter === 'forum' ? 'default' : 'outline'}
                    className={eventTypeFilter === 'forum' ? 'bg-accent text-accent-foreground' : 'border-border text-foreground hover:bg-muted'}
                  >
                    Forums
                  </Button>
                </div>
              </div>

              {/* Event Status Filters */}
              <div>
                <p className="font-paragraph text-sm font-semibold text-foreground mb-3 uppercase tracking-wide">Event Status</p>
                <div className="flex flex-wrap gap-3">
                  <Button
                    onClick={() => setStatusFilter('all')}
                    variant={statusFilter === 'all' ? 'default' : 'outline'}
                    className={statusFilter === 'all' ? 'bg-accent text-accent-foreground' : 'border-border text-foreground hover:bg-muted'}
                  >
                    All Events
                  </Button>
                  <Button
                    onClick={() => setStatusFilter('upcoming')}
                    variant={statusFilter === 'upcoming' ? 'default' : 'outline'}
                    className={statusFilter === 'upcoming' ? 'bg-accent text-accent-foreground' : 'border-border text-foreground hover:bg-muted'}
                  >
                    Upcoming
                  </Button>
                  <Button
                    onClick={() => setStatusFilter('past')}
                    variant={statusFilter === 'past' ? 'default' : 'outline'}
                    className={statusFilter === 'past' ? 'bg-accent text-accent-foreground' : 'border-border text-foreground hover:bg-muted'}
                  >
                    Past Events
                  </Button>
                </div>
              </div>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Events Grid */}
      <section className="py-20 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <div className="min-h-[500px]">
            {isLoading ? null : filteredEvents.length > 0 ? (
              <>
                {/* Upcoming Events Section */}
                {upcomingEvents.length > 0 && (
                  <div className="mb-16">
                    <div className="mb-8">
                      <div className="flex items-center gap-3 mb-2">
                        <h2 className="font-heading text-3xl md:text-4xl font-bold text-foreground">
                          Upcoming Events
                        </h2>
                        <span className="inline-block bg-accent text-accent-foreground font-paragraph text-sm font-semibold px-3 py-1 rounded-full">
                          {upcomingEvents.length}
                        </span>
                      </div>
                      <p className="font-paragraph text-muted-foreground">
                        Don't miss these upcoming opportunities to connect and grow with AmCham DRC.
                      </p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                      {upcomingEvents.map((event, index) => renderEventCard(event, index))}
                    </div>
                  </div>
                )}

                {/* Past Events Section */}
                {pastEvents.length > 0 && (
                  <div>
                    <div className="mb-8">
                      <div className="flex items-center gap-3 mb-2">
                        <h2 className="font-heading text-3xl md:text-4xl font-bold text-foreground">
                          Past Events
                        </h2>
                        <span className="inline-block bg-muted text-muted-foreground font-paragraph text-sm font-semibold px-3 py-1 rounded-full">
                          {pastEvents.length}
                        </span>
                      </div>
                      <p className="font-paragraph text-muted-foreground">
                        Explore the events we've hosted and the valuable connections made.
                      </p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto opacity-75">
                      {pastEvents.map((event, index) => renderEventCard(event, upcomingEvents.length + index))}
                    </div>
                  </div>
                )}

                {/* Load More Button */}
                {hasNext && (
                  <div className="text-center mt-12">
                    <Button
                      onClick={loadMore}
                      size="lg"
                      variant="outline"
                      className="border-foreground text-foreground hover:bg-foreground hover:text-primary"
                    >
                      Load More Events
                    </Button>
                  </div>
                )}
              </>
            ) : (
              <div className="text-center py-20">
                <Calendar size={64} className="mx-auto text-muted-foreground mb-4" />
                <h3 className="font-heading text-2xl font-bold text-foreground mb-2">
                  No Events Found
                </h3>
                <p className="font-paragraph text-muted-foreground">
                  {statusFilter === 'upcoming' 
                    ? 'No upcoming events at the moment. Check back soon!' 
                    : statusFilter === 'past'
                    ? 'No past events to display.'
                    : eventTypeFilter === 'all' 
                    ? 'Check back soon for upcoming events.' 
                    : `No ${eventTypeFilter} events available at the moment.`}
                </p>
              </div>
            )}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-24 bg-gradient-to-br from-foreground via-foreground to-foreground/90 relative overflow-hidden">
        <div className="absolute inset-0 opacity-10">
          <div className="absolute inset-0" style={{
            backgroundImage: 'radial-gradient(circle, rgba(199,210,233,0.3) 1px, transparent 1px)',
            backgroundSize: '30px 30px'
          }} />
        </div>
        
        <div className="container mx-auto px-4 relative z-10">
          <AnimatedElement>
            <div className="max-w-3xl mx-auto text-center">
              <h2 className="font-heading text-4xl md:text-5xl font-bold text-primary mb-6">
                Never Miss an Event
              </h2>
              <p className="font-paragraph text-primary/90 text-lg mb-8 leading-relaxed">
                Become a member to receive exclusive invitations and early access to all AmCham DRC events.
              </p>
              <Button 
                asChild
                size="lg"
                className="bg-accent text-accent-foreground hover:bg-accent/90 transition-all hover:scale-[1.02] shadow-lg"
              >
                <a href="/membership">Join AmCham DRC</a>
              </Button>
            </div>
          </AnimatedElement>
        </div>
      </section>

      <Footer />
    </div>
  );
}
