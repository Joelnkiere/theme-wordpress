import { useEffect, useRef, useState } from 'react';
import { Users, Target, Scale, Pickaxe } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
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

const committees = [
  {
    id: 1,
    name: 'Digital Committee',
    description: 'Focuses on digital transformation, technology adoption, and innovation in business practices.',
    icon: Target,
    color: 'bg-blue-50'
  },
  {
    id: 2,
    name: 'Legal and Tax Committee',
    description: 'Addresses legal frameworks, tax policies, and regulatory compliance for member businesses.',
    icon: Scale,
    color: 'bg-purple-50'
  },
  {
    id: 3,
    name: 'Mines Committee',
    description: 'Dedicated to mining sector development, sustainability, and industry best practices.',
    icon: Pickaxe,
    color: 'bg-amber-50'
  }
];

export default function CommitteesPage() {
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
              <p className="font-paragraph text-primary text-sm uppercase tracking-wide mb-4">Leadership</p>
              <h1 className="font-heading text-5xl md:text-6xl font-bold text-primary mb-6">
                Committees & Leadership
              </h1>
              <p className="font-paragraph text-primary/90 text-lg leading-relaxed">
                AmCham DRC's committees drive strategic initiatives and provide expert guidance across key business sectors.
              </p>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Committees Grid */}
      <section className="py-20 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
            {committees.map((committee, index) => {
              const IconComponent = committee.icon;
              return (
                <AnimatedElement key={committee.id} delay={index * 100}>
                  <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                    <CardContent className="p-8">
                      <div className={`w-16 h-16 ${committee.color} rounded-full flex items-center justify-center mb-6`}>
                        <IconComponent size={32} className="text-foreground" />
                      </div>
                      <h3 className="font-heading text-2xl font-bold text-foreground mb-3">
                        {committee.name}
                      </h3>
                      <p className="font-paragraph text-muted-foreground leading-relaxed">
                        {committee.description}
                      </p>
                    </CardContent>
                  </Card>
                </AnimatedElement>
              );
            })}
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
                Get Involved
              </h2>
              <p className="font-paragraph text-primary/90 text-lg mb-8 leading-relaxed">
                Join one of our committees and contribute to AmCham DRC's mission of promoting American business in the region.
              </p>
            </div>
          </AnimatedElement>
        </div>
      </section>

      <Footer />
    </div>
  );
}
