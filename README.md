# DePressureWasher Website

![Website Screenshot](./assets/images/home-screenshot.png)

A modern, responsive, and high-performance promotional website for **DePressureWasher**, built with HTML, Tailwind CSS, and vanilla JavaScript. This site features a seamless booking interface, SEO-optimized structure, and a comprehensive layout designed to attract and convert customers.

## Features

- **Modern Design**: Utilizes Tailwind CSS v4 for a clean, utility-first design system.
- **Responsive Layout**: Fully adaptive design for desktop, tablet, and mobile devices.
- **Smooth Animations**: Gentle hover effects, parallax scrolling, and smooth transitions for a premium feel.
- **Booking System**: Integrated booking flow with:
  - Service Selection
  - Date & Time Picker
  - Pricing Calculation
  - Testimonial Carousel
- **SEO Optimized**: Proper heading structure (H1-H6), meta tags, and semantic HTML.
- **Accessibility**: ARIA labels, focus management, and keyboard navigation support.
- **Dark Mode Support**: Built-in theme switching functionality.
- **Performance**: Optimized for speed with lazy loading and minimal dependencies.

## Installation & Setup

### Prerequisites

- **Node.js** (v18+) and **npm** (v9+) or **pnpm**.
- **Live Server** extension for VS Code (optional, for previewing).

### Quick Start

1.  **Clone the repository** (or download the source code).

2.  **Install dependencies**:
    ```bash
    npm install
    # or
    pnpm install
    ```

3.  **Run the development server**:
    ```bash
    npm run dev
    # or
    pnpm run dev
    ```

    This will start a local server (usually at `http://localhost:8080`).

4.  **Build for production**:
    ```bash
    npm run build
    # or
    pnpm run build
    ```

## Project Structure

```
/ (root)
├── assets/                # Static assets
│   ├── css/           # Compiled CSS
│   ├── fonts/         # Font files
│   ├── images/        # Images and screenshots
│   └── js/            # JavaScript files
├── index.html           # Homepage (Main entry point)
├── about.html           # About page
├── services.html        # Services page
├── booking.html         # Booking page
├── booking_confirmation.html # Booking confirmation
├── faq.html             # FAQ page
├── contact.html         # Contact page
├── sitemap.xml          # XML Sitemap
├── humans.txt           # Human-readable site info
└── manifest.json        # Progressive Web App manifest
```

## Technologies Used

- **HTML5**: Semantic structure.
- **Tailwind CSS v4**: Utility-first styling.
- **Vanilla JavaScript**: For interactivity and forms.
- **Google Fonts**: Roboto, Roboto Slab, Roboto Mono.
- **Heroicons**: SVG icons.

## Usage

### Running Locally

If you are using VS Code, you can right-click on `index.html` and select **"Open with Live Server"**.  
Alternatively, use the `npm run dev` command as described above.

### Updating Content

- **Text**: Edit the `.html` files directly.
- **Images**: Place new images in the `assets/images/` folder and update the `src` attributes in the HTML.
- **Tailwind**: If you need to customize colors or spacing, you can edit `tailwind.config.ts`.

### Build Process

The build process uses Tailwind CLI to:
1.  Process the CSS.
2.  Minify HTML.
3.  Concatenate JavaScript.

This creates an optimized `dist/` folder ready for deployment.

## Deployment

The site is static and can be deployed to any hosting provider that supports static files, such as:
- Netlify
- Vercel
- GitHub Pages
- AWS S3 / CloudFront
- Cloudflare Pages

### Example: Netlify
1.  Install Netlify CLI: `npm install -g netlify-cli`
2.  Login: `netlify login`
3.  Build & Deploy: `netlify deploy --prod`

## Browser Support

Tested on:
- Chrome (Latest)
- Firefox (Latest)
- Safari (Latest)
- Edge (Latest)