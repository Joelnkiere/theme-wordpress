import { useEffect, useRef, useState } from 'react';
import { Check, Send } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { Label } from '@/components/ui/label';
import { LoadingSpinner } from '@/components/ui/loading-spinner';
import { BaseCrudService } from '@/integrations';
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

export default function MembershipPage() {
  const [formData, setFormData] = useState({
    senderName: '',
    emailAddress: '',
    phoneNumber: '',
    companyName: '',
    subject: 'Membership Inquiry',
    messageContent: ''
  });
  const [documentFile, setDocumentFile] = useState<File | null>(null);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [submitSuccess, setSubmitSuccess] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);

    try {
      await BaseCrudService.create('contactinquiries', {
        ...formData,
        submissionDate: new Date().toISOString(),
        _id: crypto.randomUUID()
      });
      
      setSubmitSuccess(true);
      setFormData({
        senderName: '',
        emailAddress: '',
        phoneNumber: '',
        companyName: '',
        subject: 'Membership Inquiry',
        messageContent: ''
      });
      setDocumentFile(null);

      setTimeout(() => setSubmitSuccess(false), 5000);
    } catch (error) {
      console.error('Error submitting form:', error);
    } finally {
      setIsSubmitting(false);
    }
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
              <p className="font-paragraph text-primary text-sm uppercase tracking-wide mb-4">Membership</p>
              <h1 className="font-heading text-5xl md:text-6xl font-bold text-primary mb-6">
                Join the Premier<br />Business Network
              </h1>
              <p className="font-paragraph text-primary/90 text-lg leading-relaxed">
                Connect with industry leaders, access exclusive resources, and shape the future of US-DRC business relations.
              </p>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Membership Options Section */}
      <section className="py-20 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="text-center mb-16">
              <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                Membership Options
              </h2>
              <p className="font-paragraph text-muted-foreground text-lg max-w-3xl mx-auto">
                Choose the membership tier that best fits your organization's needs and goals.
              </p>
            </div>
          </AnimatedElement>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            {/* Corporate Membership */}
            <AnimatedElement delay={0}>
              <Card className="bg-card border-2 border-accent hover:shadow-2xl transition-all hover:scale-[1.02] overflow-hidden h-full relative group">
                <div className="absolute top-0 left-0 right-0 h-1 bg-accent" />
                <CardContent className="p-8">
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-2">
                    Corporate Membership
                  </h3>
                  <div className="mb-6">
                    <span className="font-heading text-4xl font-bold text-accent">$2,000</span>
                    <span className="font-paragraph text-muted-foreground ml-2">per year</span>
                  </div>
                  <p className="font-paragraph text-muted-foreground mb-6">
                    Ideal for established businesses seeking comprehensive access to AmCham DRC services and networking opportunities.
                  </p>
                  <div className="space-y-3 mb-8">
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Voting rights and board eligibility</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Unlimited event access</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Premium member directory listing</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Exclusive market intelligence reports</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Business matchmaking services</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Advocacy support and representation</span>
                    </div>
                  </div>
                  <Button 
                    asChild
                    size="lg"
                    className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                  >
                    <a href="#apply">Apply Now</a>
                  </Button>
                </CardContent>
              </Card>
            </AnimatedElement>

            {/* NGO Membership */}
            <AnimatedElement delay={100}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] overflow-hidden h-full">
                <CardContent className="p-8">
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-2">
                    NGO Membership
                  </h3>
                  <div className="mb-6">
                    <span className="font-heading text-4xl font-bold text-accent">$1,000</span>
                    <span className="font-paragraph text-muted-foreground ml-2">per year</span>
                  </div>
                  <p className="font-paragraph text-muted-foreground mb-6">
                    Perfect for non-governmental organizations and non-profit entities committed to US-DRC business development.
                  </p>
                  <div className="space-y-3 mb-8">
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Member directory listing</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Event access (discounted rates)</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Market intelligence resources</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Networking opportunities</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Collaboration initiatives</span>
                    </div>
                    <div className="flex items-start space-x-3">
                      <Check size={20} className="text-accent flex-shrink-0 mt-0.5" />
                      <span className="font-paragraph text-foreground">Newsletter and updates</span>
                    </div>
                  </div>
                  <Button 
                    asChild
                    size="lg"
                    className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                  >
                    <a href="#apply">Apply Now</a>
                  </Button>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </div>
      </section>

      {/* Apply for Membership Form - Moved right after membership types */}
      <section id="apply" className="py-20 bg-gradient-to-b from-muted/30 to-background">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="max-w-2xl mx-auto">
              <div className="text-center mb-12">
                <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                  Apply for Membership
                </h2>
                <p className="font-paragraph text-muted-foreground text-lg">
                  Fill out the form below and our team will get back to you within 24 hours.
                </p>
              </div>

              <Card className="bg-card border-border shadow-xl">
                <CardContent className="p-8">
                  <form onSubmit={handleSubmit} className="space-y-6">
                    <div>
                      <Label htmlFor="senderName" className="font-paragraph text-foreground">
                        Full Name *
                      </Label>
                      <Input
                        id="senderName"
                        type="text"
                        required
                        value={formData.senderName}
                        onChange={(e) => setFormData({ ...formData, senderName: e.target.value })}
                        className="mt-2 border-border focus:ring-accent"
                      />
                    </div>

                    <div>
                      <Label htmlFor="companyName" className="font-paragraph text-foreground">
                        Company Name *
                      </Label>
                      <Input
                        id="companyName"
                        type="text"
                        required
                        value={formData.companyName}
                        onChange={(e) => setFormData({ ...formData, companyName: e.target.value })}
                        className="mt-2 border-border focus:ring-accent"
                      />
                    </div>

                    <div>
                      <Label htmlFor="emailAddress" className="font-paragraph text-foreground">
                        Email Address *
                      </Label>
                      <Input
                        id="emailAddress"
                        type="email"
                        required
                        value={formData.emailAddress}
                        onChange={(e) => setFormData({ ...formData, emailAddress: e.target.value })}
                        className="mt-2 border-border focus:ring-accent"
                      />
                    </div>

                    <div>
                      <Label htmlFor="phoneNumber" className="font-paragraph text-foreground">
                        Phone Number
                      </Label>
                      <Input
                        id="phoneNumber"
                        type="tel"
                        value={formData.phoneNumber}
                        onChange={(e) => setFormData({ ...formData, phoneNumber: e.target.value })}
                        className="mt-2 border-border focus:ring-accent"
                      />
                    </div>

                    <div>
                      <Label htmlFor="messageContent" className="font-paragraph text-foreground">
                        Tell us about your business *
                      </Label>
                      <Textarea
                        id="messageContent"
                        required
                        rows={5}
                        value={formData.messageContent}
                        onChange={(e) => setFormData({ ...formData, messageContent: e.target.value })}
                        className="mt-2 border-border focus:ring-accent"
                        placeholder="Please describe your business, industry, and why you're interested in joining AmCham DRC..."
                      />
                    </div>

                    <div>
                      <Label htmlFor="document" className="font-paragraph text-foreground">
                        Upload Company Documents (Optional)
                      </Label>
                      <div className="mt-2 border-2 border-dashed border-border rounded-lg p-6 text-center hover:border-accent transition-colors cursor-pointer">
                        <input
                          id="document"
                          type="file"
                          onChange={(e) => setDocumentFile(e.target.files?.[0] || null)}
                          className="hidden"
                          accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                        />
                        <label htmlFor="document" className="cursor-pointer">
                          <div className="text-muted-foreground">
                            {documentFile ? (
                              <p className="font-paragraph text-accent">{documentFile.name}</p>
                            ) : (
                              <>
                                <p className="font-paragraph mb-2">Click to upload or drag and drop</p>
                                <p className="font-paragraph text-sm">PDF, DOC, XLS, PPT up to 10MB</p>
                              </>
                            )}
                          </div>
                        </label>
                      </div>
                    </div>

                    {submitSuccess && (
                      <div className="p-4 bg-accent/10 border border-accent/20 rounded-lg">
                        <p className="font-paragraph text-accent text-sm">
                          Thank you! Your membership inquiry has been submitted successfully. We'll be in touch soon.
                        </p>
                      </div>
                    )}

                    <Button
                      type="submit"
                      disabled={isSubmitting}
                      className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                      size="lg"
                    >
                      {isSubmitting ? (
                        <>
                          <LoadingSpinner className="mr-2" />
                          Submitting...
                        </>
                      ) : (
                        <>
                          <Send size={18} className="mr-2" />
                          Submit Application
                        </>
                      )}
                    </Button>
                  </form>
                </CardContent>
              </Card>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Sponsorship Options Section */}
      <section className="py-20 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="text-center mb-16">
              <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-4">
                Sponsorship Opportunities
              </h2>
              <p className="font-paragraph text-muted-foreground text-lg max-w-3xl mx-auto">
                Elevate your brand visibility and demonstrate your commitment to US-DRC business relations through strategic sponsorships.
              </p>
            </div>
          </AnimatedElement>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            {/* Platinum Sponsor */}
            <AnimatedElement delay={0}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full group">
                <CardContent className="p-8">
                  <div className="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mb-4">
                    <span className="text-2xl">👑</span>
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">
                    Platinum Sponsor
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm mb-6">
                    Premium visibility and recognition at all major AmCham DRC events and initiatives.
                  </p>
                  <div className="space-y-2 mb-6">
                    <p className="font-paragraph text-foreground font-semibold">Benefits include:</p>
                    <ul className="space-y-2 text-sm">
                      <li className="font-paragraph text-muted-foreground">• Logo on all event materials</li>
                      <li className="font-paragraph text-muted-foreground">• Speaking opportunity at events</li>
                      <li className="font-paragraph text-muted-foreground">• Premium booth at events</li>
                      <li className="font-paragraph text-muted-foreground">• Exclusive networking reception</li>
                      <li className="font-paragraph text-muted-foreground">• Annual recognition dinner</li>
                    </ul>
                  </div>
                  <Button 
                    asChild
                    className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                  >
                    <a href="#apply">Inquire</a>
                  </Button>
                </CardContent>
              </Card>
            </AnimatedElement>

            {/* Gold Sponsor */}
            <AnimatedElement delay={100}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full group">
                <CardContent className="p-8">
                  <div className="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mb-4">
                    <span className="text-2xl">⭐</span>
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">
                    Gold Sponsor
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm mb-6">
                    Strong brand presence and recognition at key AmCham DRC events throughout the year.
                  </p>
                  <div className="space-y-2 mb-6">
                    <p className="font-paragraph text-foreground font-semibold">Benefits include:</p>
                    <ul className="space-y-2 text-sm">
                      <li className="font-paragraph text-muted-foreground">• Logo on event materials</li>
                      <li className="font-paragraph text-muted-foreground">• Standard booth at events</li>
                      <li className="font-paragraph text-muted-foreground">• Networking reception access</li>
                      <li className="font-paragraph text-muted-foreground">• Member newsletter feature</li>
                      <li className="font-paragraph text-muted-foreground">• Website recognition</li>
                    </ul>
                  </div>
                  <Button 
                    asChild
                    className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                  >
                    <a href="#apply">Inquire</a>
                  </Button>
                </CardContent>
              </Card>
            </AnimatedElement>

            {/* Silver Sponsor */}
            <AnimatedElement delay={200}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full group">
                <CardContent className="p-8">
                  <div className="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mb-4">
                    <span className="text-2xl">✨</span>
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">
                    Silver Sponsor
                  </h3>
                  <p className="font-paragraph text-muted-foreground text-sm mb-6">
                    Growing brand visibility and participation in AmCham DRC community activities.
                  </p>
                  <div className="space-y-2 mb-6">
                    <p className="font-paragraph text-foreground font-semibold">Benefits include:</p>
                    <ul className="space-y-2 text-sm">
                      <li className="font-paragraph text-muted-foreground">• Event attendance</li>
                      <li className="font-paragraph text-muted-foreground">• Website listing</li>
                      <li className="font-paragraph text-muted-foreground">• Newsletter mention</li>
                      <li className="font-paragraph text-muted-foreground">• Networking access</li>
                      <li className="font-paragraph text-muted-foreground">• Member directory</li>
                    </ul>
                  </div>
                  <Button 
                    asChild
                    className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all"
                  >
                    <a href="#apply">Inquire</a>
                  </Button>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </div>
      </section>

      {/* Why Join Section */}
      <section className="py-20 bg-gradient-to-b from-muted/30 to-background">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="max-w-4xl mx-auto">
              <h2 className="font-heading text-4xl md:text-5xl font-bold text-foreground mb-12 text-center">
                Why Businesses Choose Us
              </h2>
              
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                {[
                  'Direct access to US and DRC government officials',
                  'Exclusive market intelligence and sector reports',
                  'Priority invitations to high-level networking events',
                  'Advocacy support for regulatory challenges',
                  'Business matchmaking services',
                  'Connection to AmCham global network',
                  'Visibility through member directory',
                  'Discounted rates for events and services'
                ].map((item, index) => (
                  <AnimatedElement key={index} delay={index * 50}>
                    <div className="flex items-start space-x-3 p-4 bg-card rounded-lg border border-border hover:shadow-md transition-all">
                      <div className="flex-shrink-0 w-6 h-6 bg-accent/10 rounded-full flex items-center justify-center mt-0.5">
                        <Check size={16} className="text-accent" />
                      </div>
                      <p className="font-paragraph text-foreground">{item}</p>
                    </div>
                  </AnimatedElement>
                ))}
              </div>
            </div>
          </AnimatedElement>
        </div>
      </section>

      <Footer />
    </div>
  );
}
