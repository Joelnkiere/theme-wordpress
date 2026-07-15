import { useEffect, useRef, useState } from 'react';
import { useSearchParams } from 'react-router-dom';
import { ArrowRight } from 'lucide-react';
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

interface NewsItem {
  id: string;
  title: string;
  excerpt: string;
  date: string;
  category: string;
  image: string;
  content: string;
}

const NEWS_ITEMS: NewsItem[] = [
  {
    id: '1',
    title: 'AmCham DRC and US Embassy Launch Entrepreneurship Program',
    excerpt: 'A new joint initiative between AmCham DRC and the US Embassy Kinshasa aims to empower young Congolese entrepreneurs through mentorship and training.',
    date: '7/24/2024',
    category: 'AmCham Press Releases',
    image: 'https://static.wixstatic.com/media/11e97c_ed714205d5de4c489ec8fb9f0e8811e0~mv2.png',
    content: 'A new joint initiative between AmCham DRC and the US Embassy Kinshasa aims to empower young Congolese entrepreneurs through mentorship and training. This program represents a significant commitment to fostering economic development and business growth in the DRC.'
  },
  {
    id: '2',
    title: 'AmCham DRC Hosts Annual Business Forum',
    excerpt: 'Industry leaders gathered to discuss market opportunities and regulatory developments in the DRC.',
    date: '7/20/2024',
    category: 'AmCham in the Media',
    image: 'https://static.wixstatic.com/media/11e97c_133ef5bc4d1a4cec950b46aa8cc72c9e~mv2.png',
    content: 'Industry leaders gathered at the annual AmCham DRC Business Forum to discuss market opportunities and regulatory developments in the DRC. The event featured keynote speakers from major international corporations and government officials.'
  },
  {
    id: '3',
    title: 'US Economic Growth Reaches New Heights',
    excerpt: 'Latest economic indicators show strong growth in the US market, creating new opportunities for international trade.',
    date: '7/18/2024',
    category: 'Economic & Regulatory News',
    image: 'https://static.wixstatic.com/media/11e97c_fa4194a2bba84d7c83bdb0335c4fa267~mv2.png',
    content: 'Latest economic indicators show strong growth in the US market, creating new opportunities for international trade. Analysts predict continued expansion in key sectors including technology, healthcare, and renewable energy.'
  },
  {
    id: '4',
    title: 'DRC Announces New Mining Regulations',
    excerpt: 'The DRC government has introduced updated mining regulations aimed at improving transparency and sustainability.',
    date: '7/15/2024',
    category: 'Economic & Regulatory News',
    image: 'https://static.wixstatic.com/media/11e97c_b3622f6673564605a4fdfa8b67d221f8~mv2.png',
    content: 'The DRC government has introduced updated mining regulations aimed at improving transparency and sustainability in the sector. These changes are expected to attract more foreign investment and create new business opportunities.'
  },
  {
    id: '5',
    title: 'AmCham DRC Advocacy Leads to Policy Changes',
    excerpt: 'AmCham DRC\'s advocacy efforts have resulted in important policy changes benefiting the business community.',
    date: '7/10/2024',
    category: 'AmCham Press Releases',
    image: 'https://static.wixstatic.com/media/11e97c_41d1669939b546bb84b9df911fba346a~mv2.png',
    content: 'AmCham DRC\'s advocacy efforts have resulted in important policy changes benefiting the business community. The organization continues to work closely with government officials to create a more favorable business environment.'
  },
  {
    id: '6',
    title: 'New Trade Agreement Signed Between US and DRC',
    excerpt: 'A new bilateral trade agreement has been signed, opening new opportunities for American businesses in the DRC.',
    date: '7/05/2024',
    category: 'Economic & Regulatory News',
    image: 'https://static.wixstatic.com/media/11e97c_3d7bd3d7c844468c9dac736f9aaad7bf~mv2.png',
    content: 'A new bilateral trade agreement has been signed between the US and DRC, opening new opportunities for American businesses in the region. The agreement covers multiple sectors including agriculture, manufacturing, and services.'
  }
];

export default function NewsPage() {
  const [searchParams] = useSearchParams();
  const [selectedCategory, setSelectedCategory] = useState<string>('all');
  const [filteredNews, setFilteredNews] = useState<NewsItem[]>(NEWS_ITEMS);

  useEffect(() => {
    const tab = searchParams.get('tab');
    if (tab === 'news') {
      setSelectedCategory('all');
    }
  }, [searchParams]);

  useEffect(() => {
    if (selectedCategory === 'all') {
      setFilteredNews(NEWS_ITEMS);
    } else {
      setFilteredNews(NEWS_ITEMS.filter(item => item.category === selectedCategory));
    }
  }, [selectedCategory]);

  const categories = [
    'all',
    'AmCham Press Releases',
    'AmCham in the Media',
    'Economic & Regulatory News'
  ];

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
              <p className="font-paragraph text-primary text-sm uppercase tracking-wide mb-4">AmCham News</p>
              <h1 className="font-heading text-5xl md:text-6xl font-bold text-primary mb-6">
                Latest News & Updates
              </h1>
              <p className="font-paragraph text-primary/90 text-lg leading-relaxed">
                Stay informed with the latest news from AmCham DRC, market insights, and regulatory updates.
              </p>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Category Filter */}
      <section className="py-8 bg-muted/30">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="flex flex-wrap gap-3 justify-center">
              {categories.map((category) => (
                <Button
                  key={category}
                  onClick={() => setSelectedCategory(category)}
                  variant={selectedCategory === category ? 'default' : 'outline'}
                  className={selectedCategory === category ? 'bg-accent text-accent-foreground' : 'border-border text-foreground hover:bg-muted'}
                >
                  {category === 'all' ? 'All News' : category}
                </Button>
              ))}
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* News Grid */}
      <section className="py-20 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            {filteredNews.map((item, index) => (
              <AnimatedElement key={item.id} delay={index * 50}>
                <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full group flex flex-col">
                  <div className="overflow-hidden h-48">
                    <Image 
                      src={item.image}
                      alt={item.title}
                      className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                      width={420}
                    />
                  </div>
                  <CardContent className="p-6 flex-grow flex flex-col">
                    <div className="mb-3">
                      <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full uppercase">
                        {item.category}
                      </span>
                    </div>
                    <div className="text-[10px] text-muted-foreground mb-3 uppercase tracking-widest font-bold">
                      {item.date}
                    </div>
                    <h3 className="font-heading text-xl font-bold text-foreground mb-3 group-hover:text-link transition-colors leading-snug">
                      {item.title}
                    </h3>
                    <p className="font-paragraph text-muted-foreground text-sm leading-relaxed mb-4 flex-grow">
                      {item.excerpt}
                    </p>
                    <div className="text-accent text-sm font-bold uppercase tracking-widest flex items-center group-hover:text-foreground transition-colors">
                      Read More <ArrowRight className="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform" />
                    </div>
                  </CardContent>
                </Card>
              </AnimatedElement>
            ))}
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
                Stay Updated
              </h2>
              <p className="font-paragraph text-primary/90 text-lg mb-8 leading-relaxed">
                Subscribe to our newsletter to receive the latest news, market insights, and business opportunities.
              </p>
              <Button 
                asChild
                size="lg"
                className="bg-accent text-accent-foreground hover:bg-accent/90 transition-all hover:scale-[1.02] shadow-lg"
              >
                <a href="/contact">Contact Us</a>
              </Button>
            </div>
          </AnimatedElement>
        </div>
      </section>

      <Footer />
    </div>
  );
}
