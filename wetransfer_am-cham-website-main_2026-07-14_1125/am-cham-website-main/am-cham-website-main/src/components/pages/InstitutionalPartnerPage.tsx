import React, { useEffect, useState, useRef } from 'react';
import { useNavigate } from 'react-router-dom';
import { ExternalLink, Mail, Phone } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Image } from '@/components/ui/image';
import Header from '@/components/Header';
import Footer from '@/components/Footer';

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

const partners = [
  {
    name: 'US Embassy - Democratic Republic of Congo',
    description: 'The official diplomatic mission of the United States in the DRC, promoting bilateral relations and supporting American interests.',
    contact: 'kinshasa-acs@state.gov',
    phone: '+243 (0) 81 556 0151',
    website: 'https://cd.usembassy.gov/',
    category: 'Government'
  },
  {
    name: 'American Chamber of Commerce',
    description: 'The premier business organization representing American companies and interests globally.',
    contact: 'info@amcham.org',
    phone: '+1 (212) 922-9900',
    website: 'https://www.amcham.org/',
    category: 'Chamber'
  },
  {
    name: 'ANAPI (National Agency for Investment Promotion)',
    description: 'The DRC\'s investment promotion agency, facilitating foreign direct investment and business development.',
    contact: 'contact@anapi.cd',
    phone: '+243 (0) 81 555 5555',
    website: 'https://www.anapi.cd/',
    category: 'Government'
  },
  {
    name: 'AmCham Angola',
    description: 'American Chamber of Commerce in Angola, fostering business relationships in the region.',
    contact: 'info@amcham-angola.org',
    phone: '+244 (0) 222 641 641',
    website: 'https://www.amcham-angola.org/',
    category: 'Chamber'
  },
  {
    name: 'AmCham South Africa',
    description: 'American Chamber of Commerce in South Africa, supporting US-Africa business partnerships.',
    contact: 'info@amcham.co.za',
    phone: '+27 (0) 11 646 1500',
    website: 'https://www.amcham.co.za/',
    category: 'Chamber'
  },
  {
    name: 'AmCham Kenya',
    description: 'American Chamber of Commerce in Kenya, connecting American businesses with East African markets.',
    contact: 'info@amchamkenya.org',
    phone: '+254 (0) 20 272 4000',
    website: 'https://www.amchamkenya.org/',
    category: 'Chamber'
  }
];

export default function InstitutionalPartnerPage() {
  const navigate = useNavigate();

  return (
    <div className="min-h-screen bg-background font-paragraph selection:bg-accent selection:text-white flex flex-col">
      <Header />

      <main className="flex-grow">
        {/* Hero Section */}
        <section className="relative min-h-[60vh] flex items-center pt-20 overflow-hidden bg-foreground">
          <div className="absolute inset-0 z-0">
            <div className="absolute inset-0 bg-gradient-to-r from-foreground via-foreground/80 to-transparent" />
          </div>

          <div className="container mx-auto px-6 relative z-10">
            <AnimatedElement direction="up">
              <h1 className="font-heading text-6xl md:text-7xl text-white mb-6 leading-tight">
                Institutional Partners
              </h1>
              <p className="text-primary/80 text-xl max-w-2xl font-light">
                Connect with key organizations and institutions supporting American business in the DRC and across Africa.
              </p>
            </AnimatedElement>
          </div>
        </section>

        {/* US Embassy Section */}
        <section className="py-24 bg-background">
          <div className="container mx-auto px-6">
            <AnimatedElement>
              <div className="mb-16">
                <h2 className="font-heading text-4xl md:text-5xl text-foreground mb-4">US Embassy</h2>
                <div className="w-12 h-[2px] bg-accent mb-6" />
              </div>
            </AnimatedElement>

            <AnimatedElement direction="up">
              <Card className="border-none shadow-lg bg-white rounded-none overflow-hidden">
                <CardContent className="p-8 md:p-12">
                  <div className="grid md:grid-cols-3 gap-8">
                    <div>
                      <h3 className="font-heading text-2xl text-foreground mb-4">US Embassy - DRC</h3>
                      <p className="text-muted-foreground mb-6 leading-relaxed">
                        The official diplomatic mission of the United States in the Democratic Republic of Congo, promoting bilateral relations and supporting American interests.
                      </p>
                      <Button 
                        asChild
                        className="bg-accent text-accent-foreground hover:bg-accent/90 rounded-none"
                      >
                        <a href="https://cd.usembassy.gov/" target="_blank" rel="noopener noreferrer">
                          Visit Website <ExternalLink className="w-4 h-4 ml-2" />
                        </a>
                      </Button>
                    </div>
                    <div className="md:col-span-2">
                      <div className="space-y-4">
                        <div className="flex items-start gap-4">
                          <Mail className="w-5 h-5 text-accent flex-shrink-0 mt-1" />
                          <div>
                            <div className="text-sm font-bold text-foreground uppercase tracking-widest">Email</div>
                            <a href="mailto:kinshasa-acs@state.gov" className="text-muted-foreground hover:text-accent transition-colors">
                              kinshasa-acs@state.gov
                            </a>
                          </div>
                        </div>
                        <div className="flex items-start gap-4">
                          <Phone className="w-5 h-5 text-accent flex-shrink-0 mt-1" />
                          <div>
                            <div className="text-sm font-bold text-foreground uppercase tracking-widest">Phone</div>
                            <a href="tel:+243815560151" className="text-muted-foreground hover:text-accent transition-colors">
                              +243 (0) 81 556 0151
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </section>

        {/* ANAPI Section */}
        <section className="py-24 bg-muted/30">
          <div className="container mx-auto px-6">
            <AnimatedElement>
              <div className="mb-16">
                <h2 className="font-heading text-4xl md:text-5xl text-foreground mb-4">Investment Promotion</h2>
                <div className="w-12 h-[2px] bg-accent mb-6" />
              </div>
            </AnimatedElement>

            <AnimatedElement direction="up">
              <Card className="border-none shadow-lg bg-white rounded-none overflow-hidden">
                <CardContent className="p-8 md:p-12">
                  <div className="grid md:grid-cols-3 gap-8">
                    <div>
                      <h3 className="font-heading text-2xl text-foreground mb-4">ANAPI</h3>
                      <p className="text-muted-foreground mb-6 leading-relaxed">
                        The National Agency for Investment Promotion of the DRC, facilitating foreign direct investment and supporting business development initiatives.
                      </p>
                      <Button 
                        asChild
                        className="bg-accent text-accent-foreground hover:bg-accent/90 rounded-none"
                      >
                        <a href="https://www.anapi.cd/" target="_blank" rel="noopener noreferrer">
                          Visit Website <ExternalLink className="w-4 h-4 ml-2" />
                        </a>
                      </Button>
                    </div>
                    <div className="md:col-span-2">
                      <div className="space-y-4">
                        <div className="flex items-start gap-4">
                          <Mail className="w-5 h-5 text-accent flex-shrink-0 mt-1" />
                          <div>
                            <div className="text-sm font-bold text-foreground uppercase tracking-widest">Email</div>
                            <a href="mailto:contact@anapi.cd" className="text-muted-foreground hover:text-accent transition-colors">
                              contact@anapi.cd
                            </a>
                          </div>
                        </div>
                        <div className="flex items-start gap-4">
                          <Phone className="w-5 h-5 text-accent flex-shrink-0 mt-1" />
                          <div>
                            <div className="text-sm font-bold text-foreground uppercase tracking-widest">Phone</div>
                            <a href="tel:+243815555555" className="text-muted-foreground hover:text-accent transition-colors">
                              +243 (0) 81 555 5555
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </section>

        {/* AmCham Network Section */}
        <section className="py-24 bg-background">
          <div className="container mx-auto px-6">
            <AnimatedElement>
              <div className="mb-16">
                <h2 className="font-heading text-4xl md:text-5xl text-foreground mb-4">AmCham Network in Africa</h2>
                <div className="w-12 h-[2px] bg-accent mb-6" />
                <p className="text-muted-foreground text-lg max-w-2xl">
                  Connect with American Chambers of Commerce across Africa to expand your business network.
                </p>
              </div>
            </AnimatedElement>

            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              {partners.filter(p => p.category === 'Chamber').map((partner, index) => (
                <AnimatedElement key={partner.name} delay={index * 100} direction="up">
                  <Card className="border-none shadow-sm hover:shadow-2xl transition-all duration-500 group bg-white rounded-none h-full flex flex-col overflow-hidden">
                    <CardContent className="p-8 flex-grow flex flex-col">
                      <h3 className="font-heading text-xl text-foreground mb-3 group-hover:text-accent transition-colors">
                        {partner.name}
                      </h3>
                      <p className="text-muted-foreground text-sm leading-relaxed flex-grow mb-6">
                        {partner.description}
                      </p>
                      <div className="space-y-3 border-t border-border pt-4">
                        <Button 
                          asChild
                          variant="link"
                          className="text-accent hover:text-accent/80 p-0 h-auto justify-start w-full"
                        >
                          <a href={partner.website} target="_blank" rel="noopener noreferrer">
                            Visit Website <ExternalLink className="w-4 h-4 ml-2" />
                          </a>
                        </Button>
                        <a href={`mailto:${partner.contact}`} className="text-xs text-muted-foreground hover:text-foreground transition-colors block">
                          {partner.contact}
                        </a>
                      </div>
                    </CardContent>
                  </Card>
                </AnimatedElement>
              ))}
            </div>
          </div>
        </section>

        {/* CTA Section */}
        <section className="py-24 bg-foreground text-center">
          <div className="container mx-auto px-6">
            <AnimatedElement direction="up">
              <h2 className="font-heading text-4xl md:text-5xl text-white mb-6">Ready to Connect?</h2>
              <p className="text-primary/80 max-w-2xl mx-auto mb-10 text-lg font-light">
                Reach out to our team to learn more about partnership opportunities and how we can support your business.
              </p>
              <Button 
                onClick={() => navigate('/contact')}
                className="bg-white text-foreground hover:bg-white/90 rounded-none px-10 py-6 text-sm tracking-widest uppercase font-bold transition-all"
              >
                Contact Us
              </Button>
            </AnimatedElement>
          </div>
        </section>
      </main>

      <Footer />
    </div>
  );
}
