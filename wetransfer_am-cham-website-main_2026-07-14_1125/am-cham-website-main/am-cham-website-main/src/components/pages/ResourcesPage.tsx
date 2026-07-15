import { useEffect, useRef, useState } from 'react';
import { FileText, ExternalLink, Download, Calendar } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Image } from '@/components/ui/image';
import { LoadingSpinner } from '@/components/ui/loading-spinner';
import { BaseCrudService } from '@/integrations';
import { Resources } from '@/entities';
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

export default function ResourcesPage() {
  const [resources, setResources] = useState<Resources[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [hasNext, setHasNext] = useState(false);
  const [skip, setSkip] = useState(0);

  useEffect(() => {
    loadResources();
  }, [skip]);

  const loadResources = async () => {
    try {
      const result = await BaseCrudService.getAll<Resources>('resources', [], { limit: 50, skip });
      setResources(prev => skip === 0 ? result.items : [...prev, ...result.items]);
      setHasNext(result.hasNext);
    } catch (error) {
      console.error('Error loading resources:', error);
    } finally {
      setIsLoading(false);
    }
  };

  const loadMore = () => {
    setSkip(prev => prev + 50);
  };

  // Organize resources by category and author
  const amchamPublications = resources.filter(r => r.authorSource?.toLowerCase().includes('amcham drc research team'));
  const marketInsightResources = resources.filter(r => r.category?.toLowerCase() === 'market report');
  const guideAnapiResources = resources.filter(r => r.authorSource?.toLowerCase().includes('guide anapi'));
  const externalAuthors = ['drc ministry of economy', 'kpmg', 'world bank group', 'world bank', 'imf', 'african development bank', 'adb'];
  const externalResources = resources.filter(r => 
    externalAuthors.some(author => r.authorSource?.toLowerCase().includes(author))
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
              <p className="font-paragraph text-primary text-sm uppercase tracking-wide mb-4">Resources & Reports</p>
              <h1 className="font-heading text-5xl md:text-6xl font-bold text-primary mb-6">
                Market Intelligence<br />at Your Fingertips
              </h1>
              <p className="font-paragraph text-primary/90 text-lg leading-relaxed">
                Access comprehensive market reports, sector analysis, and business intelligence to inform your DRC strategy.
              </p>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Navigation Section */}
      <section className="py-8 bg-muted/30">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="flex flex-wrap gap-3 justify-center">
              <Button
                asChild
                variant="outline"
                className="border-border text-foreground hover:bg-muted"
              >
                <a href="/resources">All Resources</a>
              </Button>
              <Button
                asChild
                variant="outline"
                className="border-border text-foreground hover:bg-muted"
              >
                <a href="/amcham-publications">AmCham Publications</a>
              </Button>
              <Button
                asChild
                variant="outline"
                className="border-border text-foreground hover:bg-muted"
              >
                <a href="/market-insights">Market Insight</a>
              </Button>
              <Button
                asChild
                variant="outline"
                className="border-border text-foreground hover:bg-muted"
              >
                <a href="/guide-anapi">Guide ANAPI</a>
              </Button>
              <Button
                asChild
                variant="outline"
                className="border-border text-foreground hover:bg-muted"
              >
                <a href="/external-resources">External Resources</a>
              </Button>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* AmCham Publications Section */}
      {amchamPublications.length > 0 && (
        <section className="py-20 bg-gradient-to-b from-background to-muted/30">
          <div className="container mx-auto px-4">
            <AnimatedElement>
              <div className="text-center mb-12">
                <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                  AmCham Publications
                </h2>
                <p className="font-paragraph text-muted-foreground text-lg max-w-3xl mx-auto">
                  Documents and papers produced by the AmCham DRC Research Team.
                </p>
              </div>
            </AnimatedElement>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
              {amchamPublications.map((resource, index) => (
                <AnimatedElement key={resource._id} delay={index * 50}>
                  <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group">
                    {resource.thumbnail && (
                      <div className="overflow-hidden">
                        <Image 
                          src={resource.thumbnail}
                          alt={resource.title || 'Resource'}
                          className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                          width={420}
                        />
                      </div>
                    )}
                    <CardContent className="p-6">
                      {resource.category && (
                        <div className="mb-3">
                          <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase">
                            {resource.category}
                          </span>
                        </div>
                      )}
                      <h3 className="font-heading text-xl font-bold text-foreground mb-3 group-hover:text-link transition-colors">
                        {resource.title}
                      </h3>
                      <p className="font-paragraph text-muted-foreground text-sm leading-relaxed mb-4 line-clamp-3">
                        {resource.description}
                      </p>
                      <div className="space-y-2 mb-4">
                        {resource.publicationDate && (
                          <div className="flex items-center space-x-2">
                            <Calendar size={14} className="text-muted-foreground" />
                            <span className="font-paragraph text-xs text-muted-foreground">
                              {new Date(resource.publicationDate).toLocaleDateString('en-US', { 
                                year: 'numeric', 
                                month: 'long' 
                              })}
                            </span>
                          </div>
                        )}
                        {resource.authorSource && (
                          <div className="flex items-center space-x-2">
                            <FileText size={14} className="text-muted-foreground" />
                            <span className="font-paragraph text-xs text-muted-foreground">
                              {resource.authorSource}
                            </span>
                          </div>
                        )}
                      </div>
                      {resource.resourceLink && (
                        <Button 
                          asChild
                          className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                        >
                          <a href={resource.resourceLink} target="_blank" rel="noopener noreferrer">
                            <ExternalLink size={16} className="mr-2" />
                            Access Resource
                          </a>
                        </Button>
                      )}
                    </CardContent>
                  </Card>
                </AnimatedElement>
              ))}
            </div>
          </div>
        </section>
      )}

      {/* Market Insight Section */}
      {marketInsightResources.length > 0 && (
        <section className="py-20 bg-background">
          <div className="container mx-auto px-4">
            <AnimatedElement>
              <div className="text-center mb-12">
                <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                  Market Insight
                </h2>
                <p className="font-paragraph text-muted-foreground text-lg max-w-3xl mx-auto">
                  Comprehensive market reports and analysis. <a href="/market-insights" className="text-accent hover:underline">View all Market Insights →</a>
                </p>
              </div>
            </AnimatedElement>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
              {marketInsightResources.slice(0, 3).map((resource, index) => (
                <AnimatedElement key={resource._id} delay={index * 50}>
                  <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group">
                    {resource.thumbnail && (
                      <div className="overflow-hidden">
                        <Image 
                          src={resource.thumbnail}
                          alt={resource.title || 'Resource'}
                          className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                          width={420}
                        />
                      </div>
                    )}
                    <CardContent className="p-6">
                      {resource.category && (
                        <div className="mb-3">
                          <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase">
                            {resource.category}
                          </span>
                        </div>
                      )}
                      <h3 className="font-heading text-xl font-bold text-foreground mb-3 group-hover:text-link transition-colors">
                        {resource.title}
                      </h3>
                      <p className="font-paragraph text-muted-foreground text-sm leading-relaxed mb-4 line-clamp-3">
                        {resource.description}
                      </p>
                      <div className="space-y-2 mb-4">
                        {resource.publicationDate && (
                          <div className="flex items-center space-x-2">
                            <Calendar size={14} className="text-muted-foreground" />
                            <span className="font-paragraph text-xs text-muted-foreground">
                              {new Date(resource.publicationDate).toLocaleDateString('en-US', { 
                                year: 'numeric', 
                                month: 'long' 
                              })}
                            </span>
                          </div>
                        )}
                        {resource.authorSource && (
                          <div className="flex items-center space-x-2">
                            <FileText size={14} className="text-muted-foreground" />
                            <span className="font-paragraph text-xs text-muted-foreground">
                              {resource.authorSource}
                            </span>
                          </div>
                        )}
                      </div>
                      {resource.resourceLink && (
                        <Button 
                          asChild
                          className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                        >
                          <a href={resource.resourceLink} target="_blank" rel="noopener noreferrer">
                            <ExternalLink size={16} className="mr-2" />
                            Access Resource
                          </a>
                        </Button>
                      )}
                    </CardContent>
                  </Card>
                </AnimatedElement>
              ))}
            </div>
          </div>
        </section>
      )}

      {/* Guide ANAPI Section */}
      {guideAnapiResources.length > 0 && (
        <section className="py-20 bg-gradient-to-b from-background to-muted/30">
          <div className="container mx-auto px-4">
            <AnimatedElement>
              <div className="text-center mb-12">
                <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                  Guide ANAPI
                </h2>
                <p className="font-paragraph text-muted-foreground text-lg max-w-3xl mx-auto">
                  Comprehensive guides and resources for business operations. <a href="/guide-anapi" className="text-accent hover:underline">View all Guides →</a>
                </p>
              </div>
            </AnimatedElement>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
              {guideAnapiResources.slice(0, 3).map((resource, index) => (
                <AnimatedElement key={resource._id} delay={index * 50}>
                  <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group">
                    {resource.thumbnail && (
                      <div className="overflow-hidden">
                        <Image 
                          src={resource.thumbnail}
                          alt={resource.title || 'Resource'}
                          className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                          width={420}
                        />
                      </div>
                    )}
                    <CardContent className="p-6">
                      {resource.category && (
                        <div className="mb-3">
                          <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase">
                            {resource.category}
                          </span>
                        </div>
                      )}
                      <h3 className="font-heading text-xl font-bold text-foreground mb-3 group-hover:text-link transition-colors">
                        {resource.title}
                      </h3>
                      <p className="font-paragraph text-muted-foreground text-sm leading-relaxed mb-4 line-clamp-3">
                        {resource.description}
                      </p>
                      <div className="space-y-2 mb-4">
                        {resource.publicationDate && (
                          <div className="flex items-center space-x-2">
                            <Calendar size={14} className="text-muted-foreground" />
                            <span className="font-paragraph text-xs text-muted-foreground">
                              {new Date(resource.publicationDate).toLocaleDateString('en-US', { 
                                year: 'numeric', 
                                month: 'long' 
                              })}
                            </span>
                          </div>
                        )}
                        {resource.authorSource && (
                          <div className="flex items-center space-x-2">
                            <FileText size={14} className="text-muted-foreground" />
                            <span className="font-paragraph text-xs text-muted-foreground">
                              {resource.authorSource}
                            </span>
                          </div>
                        )}
                      </div>
                      {resource.resourceLink && (
                        <Button 
                          asChild
                          className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                        >
                          <a href={resource.resourceLink} target="_blank" rel="noopener noreferrer">
                            <ExternalLink size={16} className="mr-2" />
                            Access Guide
                          </a>
                        </Button>
                      )}
                    </CardContent>
                  </Card>
                </AnimatedElement>
              ))}
            </div>
          </div>
        </section>
      )}

      {/* External Resources Section */}
      {externalResources.length > 0 && (
        <section className="py-20 bg-background">
          <div className="container mx-auto px-4">
            <AnimatedElement>
              <div className="text-center mb-12">
                <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                  External Resources
                </h2>
                <p className="font-paragraph text-muted-foreground text-lg max-w-3xl mx-auto">
                  In-depth analysis and insights from external organizations. <a href="/external-resources" className="text-accent hover:underline">View all External Resources →</a>
                </p>
              </div>
            </AnimatedElement>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
              {externalResources.slice(0, 3).map((resource, index) => (
                <AnimatedElement key={resource._id} delay={index * 50}>
                  <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group">
                    {resource.thumbnail && (
                      <div className="overflow-hidden">
                        <Image 
                          src={resource.thumbnail}
                          alt={resource.title || 'Resource'}
                          className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                          width={420}
                        />
                      </div>
                    )}
                    <CardContent className="p-6">
                      {resource.category && (
                        <div className="mb-3">
                          <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase">
                            {resource.category}
                          </span>
                        </div>
                      )}
                      <h3 className="font-heading text-xl font-bold text-foreground mb-3 group-hover:text-link transition-colors">
                        {resource.title}
                      </h3>
                      <p className="font-paragraph text-muted-foreground text-sm leading-relaxed mb-4 line-clamp-3">
                        {resource.description}
                      </p>
                      <div className="space-y-2 mb-4">
                        {resource.publicationDate && (
                          <div className="flex items-center space-x-2">
                            <Calendar size={14} className="text-muted-foreground" />
                            <span className="font-paragraph text-xs text-muted-foreground">
                              {new Date(resource.publicationDate).toLocaleDateString('en-US', { 
                                year: 'numeric', 
                                month: 'long' 
                              })}
                            </span>
                          </div>
                        )}
                        {resource.authorSource && (
                          <div className="flex items-center space-x-2">
                            <FileText size={14} className="text-muted-foreground" />
                            <span className="font-paragraph text-xs text-muted-foreground">
                              {resource.authorSource}
                            </span>
                          </div>
                        )}
                      </div>
                      {resource.resourceLink && (
                        <Button 
                          asChild
                          className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                        >
                          <a href={resource.resourceLink} target="_blank" rel="noopener noreferrer">
                            <ExternalLink size={16} className="mr-2" />
                            Access Resource
                          </a>
                        </Button>
                      )}
                    </CardContent>
                  </Card>
                </AnimatedElement>
              ))}
            </div>
          </div>
        </section>
      )}

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
                Need More Information?
              </h2>
              <p className="font-paragraph text-primary/90 text-lg mb-8 leading-relaxed">
                Members receive exclusive access to premium reports, sector analysis, and personalized market intelligence.
              </p>
              <Button 
                asChild
                size="lg"
                className="bg-accent text-accent-foreground hover:bg-accent/90 transition-all hover:scale-[1.02] shadow-lg"
              >
                <a href="/membership">Become a Member</a>
              </Button>
            </div>
          </AnimatedElement>
        </div>
      </section>

      <Footer />
    </div>
  );
}
