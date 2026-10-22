# ==========================================
# Stage 1: Build Frontend Assets with Node
# ==========================================
FROM node:20-alpine AS assets-builder

WORKDIR /app

# Install npm dependencies
COPY package*.json ./
RUN npm ci

# Copy frontend source files
COPY resources resources/
COPY vite.config.js tailwind.config.js postcss.config.js ./
COPY public public/

# Compile production assets with Vite
RUN npm run build

# ==========================================
# Stage 2: Production Nginx Server
# ==========================================
FROM nginx:1.27-alpine

# Copy custom Nginx configuration
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy public static files
COPY public /var/www/html/public

# Copy compiled assets from builder
COPY --from=assets-builder /app/public/build /var/www/html/public/build

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
