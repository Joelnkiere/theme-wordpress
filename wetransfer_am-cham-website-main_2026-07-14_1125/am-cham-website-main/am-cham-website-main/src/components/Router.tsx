import { MemberProvider } from '@/integrations';
import { createBrowserRouter, RouterProvider, Navigate, Outlet } from 'react-router-dom';
import { ScrollToTop } from '@/lib/scroll-to-top';
import ErrorPage from '@/integrations/errorHandlers/ErrorPage';
import HomePage from '@/components/pages/HomePage';
import AboutPage from '@/components/pages/AboutPage';
import EventsPage from '@/components/pages/EventsPage';
import MembershipPage from '@/components/pages/MembershipPage';
import MemberDirectoryPage from '@/components/pages/MemberDirectoryPage';
import ResourcesPage from '@/components/pages/ResourcesPage';
import NewsPage from '@/components/pages/NewsPage';
import CommitteesPage from '@/components/pages/CommitteesPage';
import MarketInsightPage from '@/components/pages/MarketInsightPage';
import GuideAnapiPage from '@/components/pages/GuideAnapiPage';
import ExternalResourcesPage from '@/components/pages/ExternalResourcesPage';
import InstitutionalPartnerPage from '@/components/pages/InstitutionalPartnerPage';
import ContactPage from '@/components/pages/ContactPage';
import AmchamPublicationsPage from '@/components/pages/AmchamPublicationsPage';

// Layout component that includes ScrollToTop
function Layout() {
  return (
    <>
      <ScrollToTop />
      <Outlet />
    </>
  );
}

const router = createBrowserRouter([
  {
    path: "/",
    element: <Layout />,
    errorElement: <ErrorPage />,
    children: [
      {
        index: true,
        element: <HomePage />,
        routeMetadata: {
          pageIdentifier: 'home',
        },
      },
      {
        path: "about",
        element: <AboutPage />,
        routeMetadata: {
          pageIdentifier: 'about',
        },
      },
      {
        path: "events",
        element: <EventsPage />,
        routeMetadata: {
          pageIdentifier: 'events',
        },
      },
      {
        path: "membership",
        element: <MembershipPage />,
        routeMetadata: {
          pageIdentifier: 'membership',
        },
      },
      {
        path: "member-directory",
        element: <MemberDirectoryPage />,
        routeMetadata: {
          pageIdentifier: 'member-directory',
        },
      },
      {
        path: "resources",
        element: <ResourcesPage />,
        routeMetadata: {
          pageIdentifier: 'resources',
        },
      },
      {
        path: "amcham-publications",
        element: <AmchamPublicationsPage />,
        routeMetadata: {
          pageIdentifier: 'amcham-publications',
        },
      },
      {
        path: "market-insights",
        element: <MarketInsightPage />,
        routeMetadata: {
          pageIdentifier: 'market-insights',
        },
      },
      {
        path: "guide-anapi",
        element: <GuideAnapiPage />,
        routeMetadata: {
          pageIdentifier: 'guide-anapi',
        },
      },
      {
        path: "external-resources",
        element: <ExternalResourcesPage />,
        routeMetadata: {
          pageIdentifier: 'external-resources',
        },
      },
      {
        path: "institutional-partners",
        element: <InstitutionalPartnerPage />,
        routeMetadata: {
          pageIdentifier: 'institutional-partners',
        },
      },
      {
        path: "contact",
        element: <ContactPage />,
        routeMetadata: {
          pageIdentifier: 'contact',
        },
      },
      {
        path: "news",
        element: <NewsPage />,
        routeMetadata: {
          pageIdentifier: 'news',
        },
      },
      {
        path: "committees",
        element: <CommitteesPage />,
        routeMetadata: {
          pageIdentifier: 'committees',
        },
      },
      {
        path: "*",
        element: <Navigate to="/" replace />,
      },
    ],
  },
], {
  basename: import.meta.env.BASE_NAME,
});

export default function AppRouter() {
  return (
    <MemberProvider>
      <RouterProvider router={router} />
    </MemberProvider>
  );
}
