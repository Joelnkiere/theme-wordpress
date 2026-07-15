import { useEffect, useRef, useState } from 'react';
import { Search, X } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { LoadingSpinner } from '@/components/ui/loading-spinner';
import Header from '@/components/Header';
import Footer from '@/components/Footer';

interface MemberContact {
  id: string;
  name: string;
  company: string;
  email: string;
  phone: string;
  industry: string;
  position: string;
}

// Mock member data - in a real app, this would come from a CMS collection
const MOCK_MEMBERS: MemberContact[] = [
  { id: '1', name: 'John Smith', company: 'Tech Solutions Inc', email: 'john@techsolutions.com', phone: '+243 123 456 789', industry: 'Technology', position: 'CEO' },
  { id: '2', name: 'Marie Dupont', company: 'Mining Ventures Ltd', email: 'marie@miningventures.com', phone: '+243 234 567 890', industry: 'Mining', position: 'Director' },
  { id: '3', name: 'James Wilson', company: 'Agricultural Export Co', email: 'james@agexport.com', phone: '+243 345 678 901', industry: 'Agriculture', position: 'Manager' },
  { id: '4', name: 'Sophie Laurent', company: 'Finance & Investment Group', email: 'sophie@figgroup.com', phone: '+243 456 789 012', industry: 'Finance', position: 'VP' },
  { id: '5', name: 'David Mwangi', company: 'Energy Solutions', email: 'david@energysol.com', phone: '+243 567 890 123', industry: 'Energy', position: 'Head of Operations' },
  { id: '6', name: 'Lisa Chen', company: 'Import Export Trading', email: 'lisa@ietrade.com', phone: '+243 678 901 234', industry: 'Trade', position: 'Owner' },
  { id: '7', name: 'Robert Okafor', company: 'Construction & Development', email: 'robert@condev.com', phone: '+243 789 012 345', industry: 'Construction', position: 'Project Manager' },
  { id: '8', name: 'Anna Kowalski', company: 'Healthcare Services', email: 'anna@healthserv.com', phone: '+243 890 123 456', industry: 'Healthcare', position: 'Director' },
  { id: '9', name: 'Michael Torres', company: 'Logistics Network', email: 'michael@lognet.com', phone: '+243 901 234 567', industry: 'Logistics', position: 'CEO' },
  { id: '10', name: 'Emma Johnson', company: 'Education & Training', email: 'emma@edutrain.com', phone: '+243 012 345 678', industry: 'Education', position: 'Founder' },
  { id: '11', name: 'Carlos Rodriguez', company: 'Manufacturing Corp', email: 'carlos@mfgcorp.com', phone: '+243 111 222 333', industry: 'Manufacturing', position: 'Operations Director' },
  { id: '12', name: 'Fatima Hassan', company: 'Consulting Group', email: 'fatima@consultgroup.com', phone: '+243 222 333 444', industry: 'Consulting', position: 'Senior Consultant' },
];

const INDUSTRIES = ['All', 'Technology', 'Mining', 'Agriculture', 'Finance', 'Energy', 'Trade', 'Construction', 'Healthcare', 'Logistics', 'Education', 'Manufacturing', 'Consulting'];

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

export default function MemberDirectoryPage() {
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedIndustry, setSelectedIndustry] = useState('All');
  const [filteredMembers, setFilteredMembers] = useState<MemberContact[]>(MOCK_MEMBERS);
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    setIsLoading(true);
    // Simulate loading delay
    const timer = setTimeout(() => {
      let filtered = MOCK_MEMBERS;

      // Filter by industry
      if (selectedIndustry !== 'All') {
        filtered = filtered.filter(member => member.industry === selectedIndustry);
      }

      // Filter by search term
      if (searchTerm.trim()) {
        const term = searchTerm.toLowerCase();
        filtered = filtered.filter(member =>
          member.name.toLowerCase().includes(term) ||
          member.company.toLowerCase().includes(term) ||
          member.email.toLowerCase().includes(term) ||
          member.phone.includes(term)
        );
      }

      setFilteredMembers(filtered);
      setIsLoading(false);
    }, 300);

    return () => clearTimeout(timer);
  }, [searchTerm, selectedIndustry]);

  const handleClearSearch = () => {
    setSearchTerm('');
  };

  const handleClearFilters = () => {
    setSearchTerm('');
    setSelectedIndustry('All');
  };

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
              <p className="font-paragraph text-primary text-sm uppercase tracking-wide mb-4">Directory</p>
              <h1 className="font-heading text-5xl md:text-6xl font-bold text-primary mb-6">
                Member Directory
              </h1>
              <p className="font-paragraph text-primary/90 text-lg leading-relaxed">
                Connect with business leaders and professionals across industries in the US-DRC network.
              </p>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Search and Filter Section */}
      <section className="py-12 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="max-w-5xl mx-auto">
              {/* Search Bar */}
              <div className="mb-8">
                <div className="relative">
                  <Search className="absolute left-4 top-1/2 transform -translate-y-1/2 text-muted-foreground" size={20} />
                  <Input
                    type="text"
                    placeholder="Search by name, company, email, or phone..."
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                    className="pl-12 pr-12 py-3 border-border focus:ring-accent text-base"
                  />
                  {searchTerm && (
                    <button
                      onClick={handleClearSearch}
                      className="absolute right-4 top-1/2 transform -translate-y-1/2 text-muted-foreground hover:text-foreground transition-colors"
                    >
                      <X size={20} />
                    </button>
                  )}
                </div>
              </div>

              {/* Industry Filter */}
              <div className="mb-8">
                <p className="font-paragraph text-foreground font-semibold mb-4">Filter by Industry:</p>
                <div className="flex flex-wrap gap-2">
                  {INDUSTRIES.map((industry) => (
                    <button
                      key={industry}
                      onClick={() => setSelectedIndustry(industry)}
                      className={`px-4 py-2 rounded-full font-paragraph text-sm font-medium transition-all ${
                        selectedIndustry === industry
                          ? 'bg-accent text-accent-foreground shadow-md'
                          : 'bg-card border border-border text-foreground hover:border-accent hover:shadow-sm'
                      }`}
                    >
                      {industry}
                    </button>
                  ))}
                </div>
              </div>

              {/* Clear Filters Button */}
              {(searchTerm || selectedIndustry !== 'All') && (
                <div className="flex justify-end">
                  <Button
                    onClick={handleClearFilters}
                    variant="outline"
                    className="border-border text-foreground hover:bg-muted"
                  >
                    Clear All Filters
                  </Button>
                </div>
              )}

              {/* Results Count */}
              <div className="mt-6 text-center">
                <p className="font-paragraph text-muted-foreground">
                  {isLoading ? 'Loading...' : `Found ${filteredMembers.length} member${filteredMembers.length !== 1 ? 's' : ''}`}
                </p>
              </div>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Members Grid */}
      <section className="py-20 bg-gradient-to-b from-muted/30 to-background">
        <div className="container mx-auto px-4">
          <div className="max-w-5xl mx-auto">
            {isLoading ? (
              <div className="flex justify-center items-center py-20">
                <LoadingSpinner />
              </div>
            ) : filteredMembers.length > 0 ? (
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {filteredMembers.map((member, index) => (
                  <AnimatedElement key={member.id} delay={index * 30}>
                    <Card className="bg-card border-border hover:shadow-lg transition-all hover:scale-[1.02] overflow-hidden h-full">
                      <CardContent className="p-6">
                        <div className="mb-4">
                          <div className="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mb-3">
                            <span className="text-lg font-heading font-bold text-accent">
                              {member.name.charAt(0)}
                            </span>
                          </div>
                          <h3 className="font-heading text-lg font-bold text-foreground mb-1">
                            {member.name}
                          </h3>
                          <p className="font-paragraph text-sm text-accent font-semibold mb-2">
                            {member.position}
                          </p>
                          <p className="font-paragraph text-sm text-muted-foreground mb-3">
                            {member.company}
                          </p>
                        </div>

                        <div className="mb-4 pb-4 border-b border-border">
                          <span className="inline-block bg-accent/10 text-accent font-paragraph text-xs font-semibold px-3 py-1 rounded-full">
                            {member.industry}
                          </span>
                        </div>

                        <div className="space-y-3">
                          <div>
                            <p className="font-paragraph text-xs text-muted-foreground uppercase tracking-wide mb-1">
                              Company
                            </p>
                            <p className="font-paragraph text-sm text-foreground font-medium">
                              {member.company}
                            </p>
                          </div>
                          <div>
                            <p className="font-paragraph text-xs text-muted-foreground uppercase tracking-wide mb-1">
                              CEO Name
                            </p>
                            <p className="font-paragraph text-sm text-foreground font-medium">
                              {member.name}
                            </p>
                          </div>
                          <div>
                            <p className="font-paragraph text-xs text-muted-foreground uppercase tracking-wide mb-1">
                              Email
                            </p>
                            <a
                              href={`mailto:${member.email}`}
                              className="font-paragraph text-sm text-link hover:underline break-all"
                            >
                              {member.email}
                            </a>
                          </div>
                        </div>
                      </CardContent>
                    </Card>
                  </AnimatedElement>
                ))}
              </div>
            ) : (
              <div className="text-center py-20">
                <p className="font-paragraph text-muted-foreground text-lg mb-4">
                  No members found matching your search criteria.
                </p>
                <Button
                  onClick={handleClearFilters}
                  className="bg-accent text-accent-foreground hover:bg-accent/90"
                >
                  Clear Filters
                </Button>
              </div>
            )}
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}
