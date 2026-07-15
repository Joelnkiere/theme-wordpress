import { useEffect, useRef, useState } from 'react';
import { Mail, Phone, MapPin, Clock } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { BaseCrudService } from '@/integrations';
import { ContactInquiries } from '@/entities';
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

export default function ContactPage() {
  const [formData, setFormData] = useState({
    senderName: '',
    emailAddress: '',
    phoneNumber: '',
    subject: '',
    messageContent: ''
  });
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [submitMessage, setSubmitMessage] = useState('');

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);
    setSubmitMessage('');

    try {
      await BaseCrudService.create('contactinquiries', {
        _id: crypto.randomUUID(),
        ...formData,
        submissionDate: new Date()
      });
      
      setSubmitMessage('Thank you! Your message has been sent successfully. We will get back to you soon.');
      setFormData({
        senderName: '',
        emailAddress: '',
        phoneNumber: '',
        subject: '',
        messageContent: ''
      });
    } catch (error) {
      console.error('Error submitting form:', error);
      setSubmitMessage('There was an error sending your message. Please try again.');
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
              <p className="font-paragraph text-primary text-sm uppercase tracking-wide mb-4">Get in Touch</p>
              <h1 className="font-heading text-5xl md:text-6xl font-bold text-primary mb-6">
                Contact AmCham DRC
              </h1>
              <p className="font-paragraph text-primary/90 text-lg leading-relaxed">
                Have questions or want to learn more about our services? We'd love to hear from you. Reach out to our team today.
              </p>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Contact Information & Form Section */}
      <section className="py-20 bg-gradient-to-b from-background to-muted/30">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto mb-16">
            {/* Contact Info Cards */}
            <AnimatedElement delay={0}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                <CardContent className="p-8">
                  <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <Mail size={32} className="text-accent" />
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">Email</h3>
                  <p className="font-paragraph text-muted-foreground mb-2">
                    General Inquiries:
                  </p>
                  <a href="mailto:info@amchamdrc.org" className="font-paragraph text-accent hover:text-accent/80 transition-colors">
                    info@amchamdrc.org
                  </a>
                  <p className="font-paragraph text-muted-foreground mt-4 mb-2">
                    Membership:
                  </p>
                  <a href="mailto:membership@amchamdrc.org" className="font-paragraph text-accent hover:text-accent/80 transition-colors">
                    membership@amchamdrc.org
                  </a>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={100}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                <CardContent className="p-8">
                  <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <Phone size={32} className="text-accent" />
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">Phone</h3>
                  <p className="font-paragraph text-muted-foreground mb-2">
                    Main Office:
                  </p>
                  <a href="tel:+243123456789" className="font-paragraph text-accent hover:text-accent/80 transition-colors text-lg font-semibold">
                    +243 (0) 123 456 789
                  </a>
                  <p className="font-paragraph text-muted-foreground mt-4 mb-2">
                    Business Hours:
                  </p>
                  <p className="font-paragraph text-muted-foreground">
                    Monday - Friday: 9:00 AM - 5:00 PM (CAT)
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={200}>
              <Card className="bg-card border-border hover:shadow-xl transition-all hover:scale-[1.02] h-full">
                <CardContent className="p-8">
                  <div className="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <MapPin size={32} className="text-accent" />
                  </div>
                  <h3 className="font-heading text-2xl font-bold text-foreground mb-3">Address</h3>
                  <p className="font-paragraph text-muted-foreground leading-relaxed">
                    AmCham DRC<br />
                    Avenue de la Paix<br />
                    Kinshasa, Democratic Republic of Congo<br />
                    <span className="text-sm mt-2 block">
                      P.O. Box 12345
                    </span>
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>

          {/* Map Section */}
          <AnimatedElement delay={300}>
            <div className="mb-16">
              <h2 className="font-heading text-3xl font-bold text-foreground mb-8 text-center">Visit Us</h2>
              <div className="rounded-lg overflow-hidden shadow-lg h-96 bg-muted">
                <iframe
                  width="100%"
                  height="100%"
                  style={{ border: 0 }}
                  loading="lazy"
                  allowFullScreen
                  referrerPolicy="no-referrer-when-downgrade"
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.7963662832606!2d15.312939!3d-4.3369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a6a3d5d5d5d5d5d%3A0x5d5d5d5d5d5d5d5d!2sKinshasa%2C%20Democratic%20Republic%20of%20the%20Congo!5e0!3m2!1sen!2sus!4v1234567890"
                ></iframe>
              </div>
            </div>
          </AnimatedElement>
        </div>
      </section>

      {/* Contact Form Section */}
      <section className="py-20 bg-muted/30">
        <div className="container mx-auto px-4">
          <div className="max-w-2xl mx-auto">
            <AnimatedElement>
              <div className="text-center mb-12">
                <h2 className="font-heading text-4xl font-bold text-foreground mb-4">Send us a Message</h2>
                <p className="font-paragraph text-muted-foreground text-lg">
                  Fill out the form below and we'll get back to you as soon as possible.
                </p>
              </div>
            </AnimatedElement>

            <AnimatedElement delay={100}>
              <Card className="bg-card border-border shadow-lg">
                <CardContent className="p-8">
                  <form onSubmit={handleSubmit} className="space-y-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <div>
                        <label htmlFor="senderName" className="block font-paragraph text-sm font-semibold text-foreground mb-2">
                          Full Name *
                        </label>
                        <Input
                          id="senderName"
                          name="senderName"
                          type="text"
                          value={formData.senderName}
                          onChange={handleChange}
                          required
                          placeholder="Your name"
                          className="w-full"
                        />
                      </div>
                      <div>
                        <label htmlFor="emailAddress" className="block font-paragraph text-sm font-semibold text-foreground mb-2">
                          Email Address *
                        </label>
                        <Input
                          id="emailAddress"
                          name="emailAddress"
                          type="email"
                          value={formData.emailAddress}
                          onChange={handleChange}
                          required
                          placeholder="your@email.com"
                          className="w-full"
                        />
                      </div>
                    </div>

                    <div>
                      <label htmlFor="phoneNumber" className="block font-paragraph text-sm font-semibold text-foreground mb-2">
                        Phone Number
                      </label>
                      <Input
                        id="phoneNumber"
                        name="phoneNumber"
                        type="tel"
                        value={formData.phoneNumber}
                        onChange={handleChange}
                        placeholder="+243 (0) 123 456 789"
                        className="w-full"
                      />
                    </div>

                    <div>
                      <label htmlFor="subject" className="block font-paragraph text-sm font-semibold text-foreground mb-2">
                        Subject *
                      </label>
                      <Input
                        id="subject"
                        name="subject"
                        type="text"
                        value={formData.subject}
                        onChange={handleChange}
                        required
                        placeholder="What is this about?"
                        className="w-full"
                      />
                    </div>

                    <div>
                      <label htmlFor="messageContent" className="block font-paragraph text-sm font-semibold text-foreground mb-2">
                        Message *
                      </label>
                      <Textarea
                        id="messageContent"
                        name="messageContent"
                        value={formData.messageContent}
                        onChange={handleChange}
                        required
                        placeholder="Tell us more about your inquiry..."
                        className="w-full min-h-[150px]"
                      />
                    </div>

                    {submitMessage && (
                      <div className={`p-4 rounded-lg ${submitMessage.includes('successfully') ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800'}`}>
                        <p className="font-paragraph text-sm">{submitMessage}</p>
                      </div>
                    )}

                    <Button
                      type="submit"
                      disabled={isSubmitting}
                      className="w-full bg-accent text-accent-foreground hover:bg-accent/90 transition-all py-6 text-sm tracking-widest uppercase font-bold"
                    >
                      {isSubmitting ? 'Sending...' : 'Send Message'}
                    </Button>
                  </form>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </div>
      </section>

      {/* FAQ Section */}
      <section className="py-20 bg-background">
        <div className="container mx-auto px-4">
          <AnimatedElement>
            <div className="text-center mb-12">
              <h2 className="font-heading text-4xl font-bold text-foreground mb-4">Frequently Asked Questions</h2>
              <p className="font-paragraph text-muted-foreground text-lg max-w-2xl mx-auto">
                Find answers to common questions about AmCham DRC and our services.
              </p>
            </div>
          </AnimatedElement>

          <div className="max-w-3xl mx-auto space-y-6">
            <AnimatedElement delay={0}>
              <Card className="bg-card border-border hover:shadow-lg transition-all">
                <CardContent className="p-6">
                  <h3 className="font-heading text-lg font-bold text-foreground mb-2">
                    How do I become a member?
                  </h3>
                  <p className="font-paragraph text-muted-foreground">
                    Visit our Membership page to learn about membership benefits and application requirements. You can also contact our membership team at membership@amchamdrc.org for personalized assistance.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={100}>
              <Card className="bg-card border-border hover:shadow-lg transition-all">
                <CardContent className="p-6">
                  <h3 className="font-heading text-lg font-bold text-foreground mb-2">
                    What events do you organize?
                  </h3>
                  <p className="font-paragraph text-muted-foreground">
                    We organize networking events, business forums, policy roundtables, and professional development training sessions. Check our Events page for the latest schedule and registration details.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={200}>
              <Card className="bg-card border-border hover:shadow-lg transition-all">
                <CardContent className="p-6">
                  <h3 className="font-heading text-lg font-bold text-foreground mb-2">
                    How can I access market reports?
                  </h3>
                  <p className="font-paragraph text-muted-foreground">
                    Members have access to exclusive market intelligence reports and analysis. Visit our Market Insights page to browse available resources, or contact us for custom research requests.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>

            <AnimatedElement delay={300}>
              <Card className="bg-card border-border hover:shadow-lg transition-all">
                <CardContent className="p-6">
                  <h3 className="font-heading text-lg font-bold text-foreground mb-2">
                    What is your response time?
                  </h3>
                  <p className="font-paragraph text-muted-foreground">
                    We aim to respond to all inquiries within 24-48 business hours. For urgent matters, please call our office directly during business hours.
                  </p>
                </CardContent>
              </Card>
            </AnimatedElement>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}
