// WI-HPI
import React, { useEffect, useState, useRef } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { ArrowRight, ChevronDown, ArrowUpRight, Calendar, Users, HeadphonesIcon, Play, ChevronLeft, ChevronRight } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Image } from '@/components/ui/image';
import { LoadingSpinner } from '@/components/ui/loading-spinner';
import { BaseCrudService } from '@/integrations';
import { Events, MemberBenefits } from '@/entities';
import Header from '@/components/Header';
import Footer from '@/components/Footer';
import moment from 'moment';

// Crash-Safe Animated Element
const AnimatedElement: React.FC<{
  children: React.ReactNode;
  className?: string;
  delay?: number;
  direction?: 'up' | 'left' | 'right' | 'fade';
}> = ({ children, className = '', delay = 0, direction = 'up' }) => {
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
      { threshold: 0.1, rootMargin: '50px' }
    );

    observer.observe(el);
    return () => observer.disconnect();
  }, [delay]);

  const baseClass = "transition-all duration-1000 ease-out will-change-transform";
  
  let hiddenClass = 'opacity-0 ';
  if (direction === 'up') hiddenClass += 'translate-y-12';
  else if (direction === 'left') hiddenClass += 'translate-x-12';
  else if (direction === 'right') hiddenClass += '-translate-x-12';
  else if (direction === 'fade') hiddenClass += 'scale-95';

  const visibleClass = 'opacity-100 translate-y-0 translate-x-0 scale-100';

  return (
    <div
      ref={ref}
      className={`${baseClass} ${isVisible ? visibleClass : hiddenClass} ${className}`}
    >
      {children}
    </div>
  );
};

export default function HomePage() {
  const navigate = useNavigate();
  const [events, setEvents] = useState<Events[]>([]);
  const [benefits, setBenefits] = useState<MemberBenefits[]>([]);
  const [isLoadingEvents, setIsLoadingEvents] = useState(true);
  const [isLoadingBenefits, setIsLoadingBenefits] = useState(true);
  const [currentSlide, setCurrentSlide] = useState(0);

  const slides = [
    {
      id: 1,
      title: 'Welcome to AmCham DRC',
      subtitle: 'Connecting American Business to the Democratic Republic of Congo',
      image: 'https://static.wixstatic.com/media/11e97c_3d7bd3d7c844468c9dac736f9aaad7bf~mv2.png',
      buttonText: 'Join AmCham',
      buttonAction: () => navigate('/membership')
    },
    {
      id: 2,
      title: 'Upcoming Events',
      subtitle: 'Join our exclusive networking sessions and business forums',
      image: 'https://static.wixstatic.com/media/11e97c_133ef5bc4d1a4cec950b46aa8cc72c9e~mv2.png',
      buttonText: 'View Calendar',
      buttonAction: () => navigate('/events')
    },
    {
      id: 3,
      title: 'Market Insights',
      subtitle: 'Access reports and analysis on US and DRC markets',
      image: 'https://static.wixstatic.com/media/11e97c_ed714205d5de4c489ec8fb9f0e8811e0~mv2.png',
      buttonText: 'Explore Reports',
      buttonAction: () => navigate('/resources')
    }
  ];

  useEffect(() => {
    loadEvents();
    loadBenefits();
    
    // Autoplay slideshow
    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % slides.length);
    }, 5000);
    
    return () => clearInterval(interval);
  }, []);

  const nextSlide = () => {
    setCurrentSlide((prev) => (prev + 1) % slides.length);
  };

  const prevSlide = () => {
    setCurrentSlide((prev) => (prev - 1 + slides.length) % slides.length);
  };

  const loadEvents = async () => {
    try {
      const result = await BaseCrudService.getAll<Events>('events', [], { limit: 2 });
      setEvents(result.items);
    } catch (error) {
      console.error('Error loading events:', error);
    } finally {
      setIsLoadingEvents(false);
    }
  };

  const loadBenefits = async () => {
    try {
      const result = await BaseCrudService.getAll<MemberBenefits>('memberbenefits', [], { limit: 4 });
      setBenefits(result.items);
    } catch (error) {
      console.error('Error loading benefits:', error);
    } finally {
      setIsLoadingBenefits(false);
    }
  };

  const scrollToContent = () => {
    window.scrollTo({ top: window.innerHeight, behavior: 'smooth' });
  };

  return (
    <div className="min-h-screen bg-background font-paragraph selection:bg-accent selection:text-white flex flex-col">
      <Header />

      <main className="flex-grow">
        {/* HERO SLIDESHOW SECTION */}
        <section className="relative min-h-[90vh] flex items-center pt-20 overflow-hidden">
          {/* Slideshow Container */}
          <div className="absolute inset-0 z-0">
            {slides.map((slide, index) => (
              <div
                key={slide.id}
                className={`absolute inset-0 transition-opacity duration-1000 ${
                  index === currentSlide ? 'opacity-100' : 'opacity-0'
                }`}
              >
                <Image 
                  src={slide.image}
                  alt={slide.title}
                  className="w-full h-full object-cover"
                />
                <div className="absolute inset-0 bg-gradient-to-r from-[#1d2337] via-[#1d2337]/80 to-transparent" />
                <div className="absolute inset-0 bg-gradient-to-t from-[#1d2337] via-transparent to-transparent" />
              </div>
            ))}
          </div>

          <div className="container mx-auto px-6 relative z-10">
            <div className="grid lg:grid-cols-12 gap-12 items-center">
              {/* Left Content */}
              <div className="lg:col-span-7">
                <AnimatedElement direction="up">
                  <div className="inline-flex items-center gap-2 px-3 py-1 bg-white/5 border border-white/10 rounded-full mb-6 backdrop-blur-sm">
                    <span className="w-2 h-2 rounded-full bg-accent animate-pulse" />
                    <p className="text-primary/90 text-xs font-bold uppercase tracking-widest">
                      The Voice of American Business in DRC
                    </p>
                  </div>
                </AnimatedElement>
                
                <AnimatedElement delay={100} direction="up">
                  <h1 className="font-heading text-6xl md:text-7xl lg:text-8xl text-white mb-6 leading-[1.1] tracking-tight">
                    {slides[currentSlide].title}
                  </h1>
                </AnimatedElement>
                
                <AnimatedElement delay={200} direction="up">
                  <p className="text-primary/80 text-lg md:text-xl mb-10 max-w-xl font-light">
                    {slides[currentSlide].subtitle}
                  </p>
                </AnimatedElement>
                
                <AnimatedElement delay={300} direction="up">
                  <div className="flex flex-col sm:flex-row gap-4">
                    <Button 
                      onClick={slides[currentSlide].buttonAction}
                      className="bg-accent hover:bg-accent/90 text-white rounded-none px-8 py-6 text-sm tracking-wider uppercase font-bold transition-all hover:translate-x-1"
                    >
                      {slides[currentSlide].buttonText} <ArrowRight className="ml-2 w-4 h-4" />
                    </Button>
                  </div>
                </AnimatedElement>
              </div>

              {/* Right Stats Card (Floating) */}
              <div className="lg:col-span-5 hidden lg:block">
                <AnimatedElement delay={400} direction="left">
                  <div className="bg-white/5 backdrop-blur-md border border-white/10 p-10 rounded-sm relative overflow-hidden group">
                    {/* Decorative glow */}
                    <div className="absolute -top-20 -right-20 w-64 h-64 bg-primary/10 rounded-full blur-3xl group-hover:bg-primary/20 transition-colors duration-700" />
                    
                    <div className="relative z-10">
                      <div className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center mb-8">
                        <div className="w-3 h-3 bg-white/50 rounded-full" />
                      </div>
                      
                      <h3 className="font-heading text-3xl text-white mb-2">Global Network,</h3>
                      <h3 className="font-heading text-3xl text-white/60 mb-6">Local Impact.</h3>
                      
                      <p className="text-primary/60 text-sm mb-10 leading-relaxed">
                        Connecting the Democratic Republic of Congo to the global marketplace through strategic American partnerships.
                      </p>
                      
                      <div className="grid grid-cols-3 gap-6 border-t border-white/10 pt-8">
                        <div>
                          <div className="text-white font-heading text-3xl mb-1">50+</div>
                          <div className="text-primary/50 text-[10px] uppercase tracking-widest font-bold">Members</div>
                        </div>
                        <div>
                          <div className="text-white font-heading text-3xl mb-1">12</div>
                          <div className="text-primary/50 text-[10px] uppercase tracking-widest font-bold">Events/Yr</div>
                        </div>
                        <div>
                          <div className="text-white font-heading text-3xl mb-1">24/7</div>
                          <div className="text-primary/50 text-[10px] uppercase tracking-widest font-bold">Support</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </AnimatedElement>
              </div>
            </div>
          </div>

          {/* Slideshow Controls */}
          <div className="absolute bottom-8 left-1/2 -translate-x-1/2 flex items-center gap-4 z-20">
            <button
              onClick={prevSlide}
              className="p-2 bg-white/10 hover:bg-white/20 text-white rounded-full transition-colors"
              aria-label="Previous slide"
            >
              <ChevronLeft size={20} />
            </button>
            <div className="flex gap-2">
              {slides.map((_, index) => (
                <button
                  key={index}
                  onClick={() => setCurrentSlide(index)}
                  className={`w-2 h-2 rounded-full transition-all ${
                    index === currentSlide ? 'bg-accent w-8' : 'bg-white/30 hover:bg-white/50'
                  }`}
                  aria-label={`Go to slide ${index + 1}`}
                />
              ))}
            </div>
            <button
              onClick={nextSlide}
              className="p-2 bg-white/10 hover:bg-white/20 text-white rounded-full transition-colors"
              aria-label="Next slide"
            >
              <ChevronRight size={20} />
            </button>
          </div>
        </section>

        {/* STRATEGIC SERVICES SECTION */}
        <section className="py-32 bg-background relative">
          <div className="container mx-auto px-6">
            <AnimatedElement>
              <div className="text-center mb-20">
                <h2 className="font-heading text-4xl md:text-5xl text-foreground mb-6">Strategic Services</h2>
                <div className="w-12 h-[2px] bg-accent mx-auto mb-6" />
                <p className="text-muted-foreground max-w-2xl mx-auto text-lg">
                  Comprehensive support designed to accelerate your business growth in the region.
                </p>
              </div>
            </AnimatedElement>

            <div className="min-h-[400px]">
              {isLoadingBenefits ? (
                <div className="flex justify-center items-center h-64">
                  <LoadingSpinner className="text-accent" />
                </div>
              ) : benefits.length > 0 ? (
                <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                  {benefits.map((benefit, index) => {
                    let linkPath = '/about';
                    const title = benefit.benefitTitle?.toLowerCase() || '';
                    if (title.includes('market') || title.includes('intelligence') || title.includes('reports')) {
                      linkPath = '/market-insights';
                    }
                    
                    return (
                    <AnimatedElement key={benefit._id} delay={index * 100} direction="up">
                      <Card className="border-none shadow-sm hover:shadow-2xl transition-all duration-500 group bg-white rounded-none h-full flex flex-col cursor-pointer" onClick={() => navigate(linkPath)}>
                        <div className="h-48 overflow-hidden relative">
                          <div className="absolute inset-0 bg-foreground/20 group-hover:bg-transparent transition-colors duration-500 z-10" />
                          <Image 
                            src={benefit.benefitImage || "https://static.wixstatic.com/media/11e97c_41d1669939b546bb84b9df911fba346a~mv2.png"}
                            alt={benefit.benefitTitle || 'Service'}
                            className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                          />
                        </div>
                        <CardContent className="p-8 flex-grow flex flex-col">
                          <h3 className="font-heading text-2xl text-foreground mb-4 group-hover:text-accent transition-colors">
                            {benefit.benefitTitle}
                          </h3>
                          <p className="text-muted-foreground text-sm leading-relaxed flex-grow">
                            {benefit.description}
                          </p>
                          <div className="mt-6 flex items-center text-xs font-bold uppercase tracking-wider text-foreground group-hover:text-accent transition-colors">
                            Learn More <ArrowRight className="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform" />
                          </div>
                        </CardContent>
                      </Card>
                    </AnimatedElement>
                    );
                  })}
                </div>
              ) : (
                <div className="text-center py-12 text-muted-foreground">No services available at the moment.</div>
              )}
            </div>
          </div>
        </section>

        {/* UPCOMING EVENTS SECTION (Blue Background) */}
        <section className="py-32 bg-foreground relative overflow-hidden">
          {/* Decorative Elements */}
          <div className="absolute top-0 right-0 w-[800px] h-[800px] border border-white/5 rounded-full translate-x-1/3 -translate-y-1/3 pointer-events-none" />
          <div className="absolute bottom-0 left-0 w-[600px] h-[600px] border border-white/5 rounded-full -translate-x-1/3 translate-y-1/3 pointer-events-none" />

          <div className="container mx-auto px-6 relative z-10">
            <div className="grid lg:grid-cols-12 gap-16">
              
              {/* Left: Title & CTA */}
              <div className="lg:col-span-4">
                <AnimatedElement direction="right">
                  <div className="sticky top-32">
                    <div className="flex items-center gap-3 mb-6">
                      <div className="w-8 h-[1px] bg-accent" />
                      <p className="text-accent uppercase tracking-widest text-xs font-bold">Agenda</p>
                    </div>
                    <h2 className="font-heading text-5xl md:text-6xl text-white mb-8 leading-tight">
                      Upcoming<br />Events
                    </h2>
                    <p className="text-primary/70 text-lg mb-10 font-light leading-relaxed">
                      Join our exclusive networking sessions, policy roundtables, and business forums.
                    </p>
                    <Button 
                      onClick={() => navigate('/events')}
                      variant="outline" 
                      className="border-white/20 text-white hover:bg-white hover:text-foreground rounded-none px-8 py-6 text-sm tracking-wider uppercase font-bold transition-all"
                    >
                      View Full Calendar
                    </Button>
                  </div>
                </AnimatedElement>
              </div>

              {/* Right: Event List */}
              <div className="lg:col-span-8">
                <div className="min-h-[400px]">
                  {isLoadingEvents ? (
                    <div className="flex justify-center items-center h-full">
                      <LoadingSpinner className="text-white" />
                    </div>
                  ) : events.length > 0 ? (
                    <div className="flex flex-col gap-4">
                      {events.map((event, index) => (
                        <AnimatedElement key={event._id} delay={index * 150} direction="up">
                          <div 
                            onClick={() => navigate(`/events`)}
                            className="group flex flex-col md:flex-row gap-8 p-8 border border-white/10 hover:bg-white/5 transition-all duration-300 bg-white/5 backdrop-blur-sm cursor-pointer relative overflow-hidden"
                          >
                            {/* Hover highlight line */}
                            <div className="absolute left-0 top-0 bottom-0 w-1 bg-accent scale-y-0 group-hover:scale-y-100 transition-transform origin-top duration-300" />
                            
                            {/* Date */}
                            <div className="md:w-24 flex-shrink-0 flex flex-col justify-center">
                              <div className="text-accent font-heading text-4xl mb-1">
                                {event.eventDateTime ? moment(event.eventDateTime).format('D') : '--'}
                              </div>
                              <div className="text-white/50 text-sm uppercase tracking-widest font-bold">
                                {event.eventDateTime ? moment(event.eventDateTime).format('MMM') : 'TBD'}
                              </div>
                            </div>
                            
                            {/* Content */}
                            <div className="flex-grow flex flex-col justify-center">
                              <h3 className="font-heading text-2xl text-white mb-3 group-hover:text-accent transition-colors">
                                {event.eventTitle}
                              </h3>
                              <p className="text-primary/60 text-sm line-clamp-2 mb-4 leading-relaxed">
                                {event.agenda || 'Join us for this upcoming event. More details to follow.'}
                              </p>
                              <div className="text-white/80 text-xs font-bold uppercase tracking-wider flex items-center group-hover:text-accent transition-colors">
                                Read Details <ArrowRight className="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform" />
                              </div>
                            </div>
                            
                            {/* Image (Placeholder based on screenshot style) */}
                            <div className="hidden md:block w-40 h-32 flex-shrink-0 overflow-hidden relative">
                              <div className="absolute inset-0 bg-foreground/40 group-hover:bg-transparent transition-colors duration-300 z-10" />
                              <Image 
                                src="https://static.wixstatic.com/media/11e97c_133ef5bc4d1a4cec950b46aa8cc72c9e~mv2.png" 
                                alt="Event"
                                className="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500" 
                              />
                            </div>
                          </div>
                        </AnimatedElement>
                      ))}
                    </div>
                  ) : (
                    <div className="text-center py-12 text-white/50 border border-white/10 bg-white/5 backdrop-blur-sm p-8">
                      No upcoming events scheduled at the moment.
                    </div>
                  )}
                </div>
              </div>

            </div>
          </div>
        </section>

        {/* MARKET REPORTS SECTION */}
        <section className="py-24 bg-background">
          <div className="container mx-auto px-6">
            <AnimatedElement direction="up">
              <div className="bg-[#F5EBEB] p-12 md:p-16 max-w-4xl relative overflow-hidden group cursor-pointer" onClick={() => navigate('/resources')}>
                {/* Decorative icon */}
                <div className="absolute top-0 left-0 w-16 h-16 bg-accent text-white flex items-center justify-center transition-transform group-hover:scale-110 origin-top-left">
                  <ArrowUpRight className="w-6 h-6" />
                </div>
                
                <div className="pl-8 md:pl-12">
                  <h2 className="font-heading text-4xl text-foreground mb-6">DRC Market Reports</h2>
                  <p className="text-muted-foreground mb-10 max-w-xl text-lg leading-relaxed">
                    Access in-depth analysis, sector reports, and economic indicators prepared by the International Trade Administration.
                  </p>
                  <div className="text-accent text-sm font-bold uppercase tracking-widest flex items-center group-hover:text-foreground transition-colors">
                    Access Reports <ArrowRight className="w-4 h-4 ml-3 transform group-hover:translate-x-2 transition-transform" />
                  </div>
                </div>
              </div>
            </AnimatedElement>
          </div>
        </section>

        {/* LATEST NEWS SECTION (Static from Markdown) */}
        <section className="py-32 bg-background border-t border-border/30">
          <div className="container mx-auto px-6">
            <AnimatedElement>
              <div className="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <h2 className="font-heading text-5xl text-foreground">Latest News</h2>
                <Button 
                  variant="link" 
                  onClick={() => navigate('/news')}
                  className="text-muted-foreground hover:text-foreground uppercase tracking-widest text-xs font-bold p-0 h-auto"
                >
                  View All Articles
                </Button>
              </div>
            </AnimatedElement>

            <div className="grid lg:grid-cols-12 gap-12">
              {/* Featured Article */}
              <div className="lg:col-span-8">
                <AnimatedElement delay={100} direction="up">
                  <div className="group cursor-pointer" onClick={() => navigate('/news')}>
                    <div className="mb-8 overflow-hidden relative">
                      <div className="absolute inset-0 bg-foreground/10 group-hover:bg-transparent transition-colors duration-500 z-10" />
                      <Image 
                        src="https://static.wixstatic.com/media/11e97c_ed714205d5de4c489ec8fb9f0e8811e0~mv2.png" 
                        alt="News"
                        className="w-full aspect-[16/9] object-cover group-hover:scale-105 transition-transform duration-700" 
                      />
                    </div>
                    <div className="flex items-center gap-4 text-[10px] text-muted-foreground mb-4 uppercase tracking-widest font-bold">
                      <span className="text-accent">Featured</span>
                      <span>•</span>
                      <span>7/24/2024</span>
                      <span>•</span>
                      <span>AmCham DRC Board</span>
                    </div>
                    <h3 className="font-heading text-3xl md:text-4xl text-foreground mb-4 group-hover:text-accent transition-colors leading-tight">
                      AmCham DRC and US Embassy Launch Entrepreneurship Program
                    </h3>
                    <p className="text-muted-foreground text-lg leading-relaxed max-w-3xl">
                      A new joint initiative between AmCham DRC and the US Embassy Kinshasa aims to empower young Congolese entrepreneurs through mentorship and training.
                    </p>
                  </div>
                </AnimatedElement>
              </div>

              {/* Side Articles */}
              <div className="lg:col-span-4 flex flex-col gap-10">
                <AnimatedElement delay={200} direction="left">
                  <div className="group cursor-pointer flex flex-col gap-4" onClick={() => navigate('/news')}>
                    <div className="overflow-hidden h-48">
                      <Image 
                        src="https://static.wixstatic.com/media/11e97c_fa4194a2bba84d7c83bdb0335c4fa267~mv2.png" 
                        alt="Report"
                        className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                      />
                    </div>
                    <div>
                      <div className="text-[10px] text-muted-foreground mb-2 uppercase tracking-widest font-bold">7/19/2024</div>
                      <h4 className="font-heading text-xl text-foreground group-hover:text-accent transition-colors leading-snug">
                        New DRC Market Report 2024: Key Insights for Investors
                      </h4>
                    </div>
                  </div>
                </AnimatedElement>

                <AnimatedElement delay={300} direction="left">
                  <div className="group cursor-pointer flex flex-col gap-4" onClick={() => navigate('/news')}>
                    <div className="overflow-hidden h-48">
                      <Image 
                        src="https://static.wixstatic.com/media/11e97c_b3622f6673564605a4fdfa8b67d221f8~mv2.png" 
                        alt="Mining"
                        className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                      />
                    </div>
                    <div>
                      <div className="text-[10px] text-muted-foreground mb-2 uppercase tracking-widest font-bold">7/14/2024</div>
                      <h4 className="font-heading text-xl text-foreground group-hover:text-accent transition-colors leading-snug">
                        Major US Investment Boosts DRC Mining Sector
                      </h4>
                    </div>
                  </div>
                </AnimatedElement>
              </div>
            </div>
          </div>
        </section>

        {/* CTA SECTION */}
        <section className="py-32 bg-[#1A1F24] text-center relative overflow-hidden">
          {/* Subtle background pattern */}
          <div className="absolute inset-0 opacity-5" style={{ backgroundImage: 'radial-gradient(circle, #ffffff 1px, transparent 1px)', backgroundSize: '40px 40px' }} />
          
          <div className="container mx-auto px-6 relative z-10">
            <AnimatedElement direction="up">
              <h2 className="font-heading text-5xl md:text-6xl text-white mb-8">Become a Member</h2>
              <p className="text-white/60 max-w-2xl mx-auto mb-12 text-lg font-light leading-relaxed">
                Join a prestigious network of businesses committed to excellence and growth in the DRC. Gain access to exclusive resources, advocacy, and connections.
              </p>
              <div className="flex flex-col sm:flex-row justify-center gap-6">
                <Button 
                  onClick={() => navigate('/membership')}
                  className="bg-white text-foreground hover:bg-white/90 rounded-none px-10 py-7 text-sm tracking-widest uppercase font-bold transition-all hover:scale-105"
                >
                  Apply Now
                </Button>
                <Button 
                  onClick={() => navigate('/contact')}
                  variant="outline" 
                  className="border-white/20 text-white hover:bg-white/10 rounded-none px-10 py-7 text-sm tracking-widest uppercase font-bold transition-all"
                >
                  Contact Us
                </Button>
              </div>
            </AnimatedElement>
          </div>
        </section>
      </main>

      <Footer />
    </div>
  );
}