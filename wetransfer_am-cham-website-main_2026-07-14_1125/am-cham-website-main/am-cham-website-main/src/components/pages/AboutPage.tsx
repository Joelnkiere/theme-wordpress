import { useEffect, useRef, useState } from 'react';
import { Link } from 'react-router-dom';
import { Target, TrendingUp, Users, Globe } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Image } from '@/components/ui/image';
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

export default function AboutPage() {
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
              <p className="font-paragraph text-primary text-sm uppercase tracking-wide mb-4">About Us</p>
              <h1 className="font-heading text-5xl md:text-6xl font-bold text-primary mb-6">
                Connecting Economies,<br />Empowering Business
              </h1>
              <p className="font-paragraph text-primary/90 text-lg leading-relaxed">
                AmCham DRC serves as the premier platform for American businesses operating in the Democratic Republic of Congo, fostering trade, investment, and sustainable economic growth.
              </p>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Mission & Vision */}
      <section className="py-20 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <AnimatedElement>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                <CardContent className="p-8">
                  <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <Target size={32} className="text-accent" />
                  </div>
                  <h2 className="font-heading text-3xl font-bold text-foreground mb-4">Our Mission</h2>
                  <p className="font-paragraph text-muted-foreground leading-relaxed">
                    To promote and facilitate trade and investment between the United States and the Democratic Republic of Congo by providing advocacy, networking opportunities, and business intelligence to our members.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={100}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                <CardContent className="p-8">
                  <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <TrendingUp size={32} className="text-accent" />
                  </div>
                  <h2 className="font-heading text-3xl font-bold text-foreground mb-4">Our Vision</h2>
                  <p className="font-paragraph text-muted-foreground leading-relaxed">
                    To be the leading voice of American business in the DRC, driving sustainable economic development and creating lasting partnerships that benefit both nations.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </div>
      </section>

      {/* What We Do */}
      <section className="py-20 bg-gradient-to-b from-muted/30 to-background">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="text-center mb-16">
              <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                What We Do
              </h2>
              <p className="font-paragraph text-muted-foreground text-lg max-w-3xl mx-auto">
                AmCham DRC provides comprehensive services to support American businesses in the DRC market.
              </p>
            </div>
          </AnimatedElement>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            <AnimatedElement delay={0}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full group">
                <CardContent className="p-6">
                  <div className="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center mb-4 group-hover:bg-accent/20 transition-colors">
                    <Users size={24} className="text-accent" />
                  </div>
                  <h3 className="font-heading text-xl font-bold text-foreground mb-3">
                    Business Matchmaking
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm leading-relaxed">
                    Connecting US and DRC businesses for strategic partnerships and investment opportunities.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={100}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full group">
                <CardContent className="p-6">
                  <div className="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center mb-4 group-hover:bg-accent/20 transition-colors">
                    <Globe size={24} className="text-accent" />
                  </div>
                  <h3 className="font-heading text-xl font-bold text-foreground mb-3">
                    Networking Events
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm leading-relaxed">
                    Exclusive events designed to foster connections, share insights, and build a strong business community.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={200}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full group">
                <CardContent className="p-6">
                  <div className="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center mb-4 group-hover:bg-accent/20 transition-colors">
                    <Target size={24} className="text-accent" />
                  </div>
                  <h3 className="font-heading text-xl font-bold text-foreground mb-3">
                    Advocacy & Dialogue
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm leading-relaxed">
                    Representing member interests and promoting a favorable business climate in the DRC.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={300}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full group">
                <CardContent className="p-6">
                  <div className="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center mb-4 group-hover:bg-accent/20 transition-colors">
                    <TrendingUp size={24} className="text-accent" />
                  </div>
                  <h3 className="font-heading text-xl font-bold text-foreground mb-3">
                    Market Intelligence
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm leading-relaxed">
                    Providing critical market intelligence and guidance for successful entry into the DRC market.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </div>
      </section>

      {/* Board Members Section */}
      <section className="py-20 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="text-center mb-16">
              <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                Our Board of Directors
              </h2>
              <p className="font-paragraph text-muted-foreground text-lg max-w-3xl mx-auto">
                Meet the leadership team guiding AmCham DRC's mission to strengthen US-DRC business relations.
              </p>
            </div>
          </AnimatedElement>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 max-w-7xl mx-auto">
            {/* President */}
            <AnimatedElement delay={0}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group text-center">
                <div className="overflow-hidden h-64 bg-muted">
                  <div className="w-full h-full bg-gradient-to-br from-accent/20 to-accent/5 flex items-center justify-center">
                    <Users size={48} className="text-accent/30" />
                  </div>
                </div>
                <CardContent className="p-6">
                  <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase mb-3">
                    President
                  </span>
                  <h3 className="font-heading text-xl font-bold text-foreground mb-2">
                    Yannick Sukakumu
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm">
                    Raxio DRC
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            {/* Vice President */}
            <AnimatedElement delay={100}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group text-center">
                <div className="overflow-hidden h-64 bg-muted">
                  <div className="w-full h-full bg-gradient-to-br from-accent/20 to-accent/5 flex items-center justify-center">
                    <Users size={48} className="text-accent/30" />
                  </div>
                </div>
                <CardContent className="p-6">
                  <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase mb-3">
                    Vice President
                  </span>
                  <h3 className="font-heading text-xl font-bold text-foreground mb-2">
                    Wilmot Gibson
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm">
                    Musau Entreprise
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            {/* Treasurer */}
            <AnimatedElement delay={200}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group text-center">
                <div className="overflow-hidden h-64 bg-muted">
                  <div className="w-full h-full bg-gradient-to-br from-accent/20 to-accent/5 flex items-center justify-center">
                    <Users size={48} className="text-accent/30" />
                  </div>
                </div>
                <CardContent className="p-6">
                  <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase mb-3">
                    Treasurer
                  </span>
                  <h3 className="font-heading text-xl font-bold text-foreground mb-2">
                    Zahid Mirr
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm">
                    Keytech
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            {/* Board Member 1 */}
            <AnimatedElement delay={300}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group text-center">
                <div className="overflow-hidden h-64 bg-muted">
                  <div className="w-full h-full bg-gradient-to-br from-accent/20 to-accent/5 flex items-center justify-center">
                    <Users size={48} className="text-accent/30" />
                  </div>
                </div>
                <CardContent className="p-6">
                  <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase mb-3">
                    Board Member
                  </span>
                  <h3 className="font-heading text-xl font-bold text-foreground mb-2">
                    Mirela Pekmezi
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm">
                    FINCA
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            {/* Board Member 2 */}
            <AnimatedElement delay={400}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group text-center">
                <div className="overflow-hidden h-64 bg-muted">
                  <div className="w-full h-full bg-gradient-to-br from-accent/20 to-accent/5 flex items-center justify-center">
                    <Users size={48} className="text-accent/30" />
                  </div>
                </div>
                <CardContent className="p-6">
                  <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase mb-3">
                    Board Member
                  </span>
                  <h3 className="font-heading text-xl font-bold text-foreground mb-2">
                    Patricia Veringa Gieskes
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm">
                    PVG Trust
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </div>
      </section>

      {/* Core Values Section */}
      <section className="py-20 bg-gradient-to-b from-muted/30 to-background">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="text-center mb-16">
              <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                Our Core Values
              </h2>
              <p className="font-paragraph text-muted-foreground text-lg max-w-3xl mx-auto">
                The principles that guide our mission and shape our commitment to the business community.
              </p>
            </div>
          </AnimatedElement>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <AnimatedElement delay={0}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                <CardContent className="p-8">
                  <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <span className="text-3xl">🤝</span>
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">Integrity</h3>
                  <p className="font-paragraph text-muted-foreground leading-relaxed">
                    We conduct our business with honesty, transparency, and ethical practices, building trust with all stakeholders.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={100}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                <CardContent className="p-8">
                  <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <span className="text-3xl">🌍</span>
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">Collaboration</h3>
                  <p className="font-paragraph text-muted-foreground leading-relaxed">
                    We foster partnerships and cooperation between American and Congolese businesses to create mutual growth opportunities.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={200}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                <CardContent className="p-8">
                  <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <span className="text-3xl">💡</span>
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">Innovation</h3>
                  <p className="font-paragraph text-muted-foreground leading-relaxed">
                    We embrace new ideas and approaches to address the evolving challenges and opportunities in the DRC market.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={300}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                <CardContent className="p-8">
                  <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <span className="text-3xl">📈</span>
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">Sustainability</h3>
                  <p className="font-paragraph text-muted-foreground leading-relaxed">
                    We promote responsible business practices that support long-term economic growth and social development.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </div>
      </section>

      {/* History Section */}
      <section className="py-20 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="max-w-4xl mx-auto">
              <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-8 text-center">
                Our History
              </h2>
              
              <div className="space-y-8">
                <Card className="bg-card border-border hover:shadow-lg transition-all">
                  <CardContent className="p-8">
                    <h3 className="font-heading text-2xl font-bold text-foreground mb-3">
                      Founding & Early Years
                    </h3>
                    <p className="font-paragraph text-muted-foreground leading-relaxed">
                      AmCham DRC was established with a mission to strengthen the economic ties between the United States and the Democratic Republic of Congo. Since our inception, we have been committed to fostering a vibrant business community that promotes trade, investment, and mutual prosperity.
                    </p>
                  </CardContent>
                </Card>

                <Card className="bg-card border-border hover:shadow-lg transition-all">
                  <CardContent className="p-8">
                    <h3 className="font-heading text-2xl font-bold text-foreground mb-3">
                      Growth & Expansion
                    </h3>
                    <p className="font-paragraph text-muted-foreground leading-relaxed">
                      Over the years, AmCham DRC has grown to become a leading voice for American business interests in the country. We have expanded our membership base, increased our advocacy efforts, and developed comprehensive programs to support our members' success in the DRC market.
                    </p>
                  </CardContent>
                </Card>

                <Card className="bg-card border-border hover:shadow-lg transition-all">
                  <CardContent className="p-8">
                    <h3 className="font-heading text-2xl font-bold text-foreground mb-3">
                      Current Impact
                    </h3>
                    <p className="font-paragraph text-muted-foreground leading-relaxed">
                      Today, AmCham DRC continues to play a vital role in facilitating business connections, providing market intelligence, and advocating for policies that support US-DRC trade relations. We remain dedicated to creating opportunities for our members and contributing to the economic development of the Democratic Republic of Congo.
                    </p>
                  </CardContent>
                </Card>
              </div>
            </div>
          </AnimatedElement>
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
                Ready to Join Us?
              </h2>
              <p className="font-paragraph text-primary/90 text-lg mb-8 leading-relaxed">
                Become part of a dynamic community of businesses shaping the future of US-DRC trade relations.
              </p>
              <div className="flex flex-col sm:flex-row gap-4 justify-center">
                <Button 
                  asChild
                  size="lg"
                  className="bg-accent text-accent-foreground hover:bg-accent/90 transition-all hover:scale-[1.02] shadow-lg"
                >
                  <Link to="/membership">Apply for Membership</Link>
                </Button>
                <Button 
                  asChild
                  size="lg"
                  variant="outline"
                  className="bg-primary/10 text-primary border-primary hover:bg-primary/20 transition-all hover:scale-[1.02]"
                >
                  <Link to="/events">View Our Events</Link>
                </Button>
              </div>
            </div>
          </AnimatedElement>
        </div>
      </section>

      <Footer />
    </div>
  );
}
