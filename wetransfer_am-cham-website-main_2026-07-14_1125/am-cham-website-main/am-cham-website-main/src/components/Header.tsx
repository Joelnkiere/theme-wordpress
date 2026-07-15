import { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { Menu, X, ChevronDown } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Image } from '@/components/ui/image';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';

export default function Header() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const location = useLocation();

  const navLinks = [
    { path: '/', label: 'Home' },
    { path: '/about', label: 'About Us', hasDropdown: true },
    { path: '/events', label: 'Events' },
    { path: '/institutional-partners', label: 'Partners' },
    { path: '/membership', label: 'Membership', hasDropdown: true },
    { path: '/resources', label: 'Resources', hasDropdown: true },
    { path: '/contact', label: 'Contact' }
  ];

  const isActive = (path: string) => location.pathname === path;

  return (
    <header className="sticky top-0 z-50 bg-background/95 backdrop-blur-sm border-b border-border shadow-sm">
      <div className="container mx-auto px-4 py-3">
        <div className="flex items-center justify-between">
          {/* Logo */}
          <Link to="/" className="flex items-center space-x-3 group">
            <Image 
              src="https://static.wixstatic.com/media/11e97c_28880babc60b4965a38e9358418c9b9c~mv2.png"
              alt="AmCham DRC Logo"
              width={50}
              className="h-auto"
            />
            <div className="flex flex-col">
              <div className="text-xl font-heading font-bold text-foreground transition-colors group-hover:text-link">
                AmCham DRC
              </div>
              <div className="text-xs font-paragraph text-muted-foreground">
                American Chamber of Commerce
              </div>
            </div>
          </Link>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex items-center space-x-1">
            {navLinks.map((link) => {
              if (link.hasDropdown && link.label === 'About Us') {
                return (
                  <DropdownMenu key={link.path}>
                    <DropdownMenuTrigger asChild>
                      <button className={`font-paragraph text-sm font-medium transition-colors hover:text-link flex items-center gap-1 px-3 py-2 ${
                        isActive(link.path) ? 'text-link' : 'text-foreground'
                      }`}>
                        {link.label}
                        <ChevronDown size={16} />
                      </button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="start" className="w-48">
                      <DropdownMenuItem asChild>
                        <Link to="/about" className="cursor-pointer">
                          About Overview
                        </Link>
                      </DropdownMenuItem>
                      <DropdownMenuItem asChild>
                        <Link to="/committees" className="cursor-pointer">
                          Committees
                        </Link>
                      </DropdownMenuItem>
                    </DropdownMenuContent>
                  </DropdownMenu>
                );
              }
              
              if (link.hasDropdown && link.label === 'Membership') {
                return (
                  <DropdownMenu key={link.path}>
                    <DropdownMenuTrigger asChild>
                      <button className={`font-paragraph text-sm font-medium transition-colors hover:text-link flex items-center gap-1 px-3 py-2 ${
                        isActive(link.path) ? 'text-link' : 'text-foreground'
                      }`}>
                        {link.label}
                        <ChevronDown size={16} />
                      </button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="start" className="w-48">
                      <DropdownMenuItem asChild>
                        <Link to="/membership" className="cursor-pointer">
                          Membership Overview
                        </Link>
                      </DropdownMenuItem>
                      <DropdownMenuItem asChild>
                        <Link to="/member-directory" className="cursor-pointer">
                          Member Directory
                        </Link>
                      </DropdownMenuItem>
                    </DropdownMenuContent>
                  </DropdownMenu>
                );
              }
              
              if (link.hasDropdown && link.label === 'Resources') {
                return (
                  <DropdownMenu key={link.path}>
                    <DropdownMenuTrigger asChild>
                      <button className={`font-paragraph text-sm font-medium transition-colors hover:text-link flex items-center gap-1 px-3 py-2 ${
                        isActive(link.path) ? 'text-link' : 'text-foreground'
                      }`}>
                        {link.label}
                        <ChevronDown size={16} />
                      </button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="start" className="w-48">
                      <DropdownMenuItem asChild>
                        <Link to="/resources" className="cursor-pointer">
                          Resources Overview
                        </Link>
                      </DropdownMenuItem>
                      <DropdownMenuItem asChild>
                        <Link to="/news" className="cursor-pointer">
                          News
                        </Link>
                      </DropdownMenuItem>
                    </DropdownMenuContent>
                  </DropdownMenu>
                );
              }

              return (
                <Link
                  key={link.path}
                  to={link.path}
                  className={`font-paragraph text-sm font-medium transition-colors hover:text-link px-3 py-2 ${
                    isActive(link.path) ? 'text-link' : 'text-foreground'
                  }`}
                >
                  {link.label}
                </Link>
              );
            })}
          </nav>

          {/* CTA Button */}
          <div className="hidden md:block">
            <Button 
              asChild
              className="bg-accent text-accent-foreground hover:bg-accent/90 transition-all hover:scale-[1.02] shadow-md"
            >
              <Link to="/membership">Join Now</Link>
            </Button>
          </div>

          {/* Mobile Menu Button */}
          <button
            onClick={() => setIsMenuOpen(!isMenuOpen)}
            className="md:hidden p-2 text-foreground hover:text-link transition-colors"
            aria-label="Toggle menu"
          >
            {isMenuOpen ? <X size={24} /> : <Menu size={24} />}
          </button>
        </div>

        {/* Mobile Navigation */}
        {isMenuOpen && (
          <nav className="md:hidden mt-4 pb-4 border-t border-border pt-4 space-y-3">
            {navLinks.map((link) => (
              <Link
                key={link.path}
                to={link.path}
                onClick={() => setIsMenuOpen(false)}
                className={`block font-paragraph text-sm font-medium transition-colors hover:text-link ${
                  isActive(link.path) ? 'text-link' : 'text-foreground'
                }`}
              >
                {link.label}
              </Link>
            ))}
            <Button 
              asChild
              className="w-full bg-accent text-accent-foreground hover:bg-accent/90"
            >
              <Link to="/membership" onClick={() => setIsMenuOpen(false)}>Join Now</Link>
            </Button>
          </nav>
        )}
      </div>
    </header>
  );
}
