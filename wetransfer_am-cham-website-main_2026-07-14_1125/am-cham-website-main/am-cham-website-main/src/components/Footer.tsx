import { Link } from 'react-router-dom';
import { Mail, Phone, MapPin, Linkedin, Twitter, Facebook } from 'lucide-react';

export default function Footer() {
  return (
    <footer className="bg-foreground text-primary-foreground">
      <div className="container mx-auto px-4 py-12">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {/* About Section */}
          <div>
            <h3 className="text-xl font-heading font-bold mb-4 text-primary">AmCham DRC</h3>
            <p className="font-paragraph text-sm text-primary/90 leading-relaxed">
              The American Chamber of Commerce in the Democratic Republic of Congo, promoting trade and investment between the US and DRC.
            </p>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="text-lg font-heading font-semibold mb-4 text-primary">Quick Links</h4>
            <ul className="space-y-2">
              <li>
                <Link to="/about" className="font-paragraph text-sm text-primary/90 hover:text-primary transition-colors">
                  About Us
                </Link>
              </li>
              <li>
                <Link to="/events" className="font-paragraph text-sm text-primary/90 hover:text-primary transition-colors">
                  Events
                </Link>
              </li>
              <li>
                <Link to="/membership" className="font-paragraph text-sm text-primary/90 hover:text-primary transition-colors">
                  Membership
                </Link>
              </li>
              <li>
                <Link to="/resources" className="font-paragraph text-sm text-primary/90 hover:text-primary transition-colors">
                  Resources
                </Link>
              </li>
            </ul>
          </div>

          {/* Contact Info */}
          <div>
            <h4 className="text-lg font-heading font-semibold mb-4 text-primary">Contact Us</h4>
            <ul className="space-y-3">
              <li className="flex items-start space-x-2">
                <MapPin size={16} className="mt-1 text-primary flex-shrink-0" />
                <span className="font-paragraph text-sm text-primary/90">Kinshasa, Democratic Republic of Congo</span>
              </li>
              <li className="flex items-center space-x-2">
                <Mail size={16} className="text-primary flex-shrink-0" />
                <a href="mailto:info@amchamdrc.org" className="font-paragraph text-sm text-primary/90 hover:text-primary transition-colors">
                  info@amchamdrc.org
                </a>
              </li>
              <li className="flex items-center space-x-2">
                <Phone size={16} className="text-primary flex-shrink-0" />
                <span className="font-paragraph text-sm text-primary/90">+243 XXX XXX XXX</span>
              </li>
            </ul>
          </div>

          {/* Social Media */}
          <div>
            <h4 className="text-lg font-heading font-semibold mb-4 text-primary">Follow Us</h4>
            <div className="flex space-x-4">
              <a 
                href="https://linkedin.com" 
                target="_blank" 
                rel="noopener noreferrer"
                className="p-2 bg-primary/10 rounded-full hover:bg-primary/20 transition-colors"
                aria-label="LinkedIn"
              >
                <Linkedin size={20} className="text-primary" />
              </a>
              <a 
                href="https://twitter.com" 
                target="_blank" 
                rel="noopener noreferrer"
                className="p-2 bg-primary/10 rounded-full hover:bg-primary/20 transition-colors"
                aria-label="Twitter"
              >
                <Twitter size={20} className="text-primary" />
              </a>
              <a 
                href="https://facebook.com" 
                target="_blank" 
                rel="noopener noreferrer"
                className="p-2 bg-primary/10 rounded-full hover:bg-primary/20 transition-colors"
                aria-label="Facebook"
              >
                <Facebook size={20} className="text-primary" />
              </a>
            </div>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="mt-12 pt-8 border-t border-primary/20">
          <div className="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p className="font-paragraph text-sm text-primary/80">
              © 2026 my-site-xh8bc7ou-emmakembia.wix-vibe.com. All rights reserved.
            </p>
            <div className="flex space-x-6">
              <a href="#" className="font-paragraph text-sm text-primary/80 hover:text-primary transition-colors">
                Privacy Policy
              </a>
              <a href="#" className="font-paragraph text-sm text-primary/80 hover:text-primary transition-colors">
                Terms of Service
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
}
