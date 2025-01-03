# Stage 1: Build the Vue.js application
FROM node:18 AS build

# Set working directory
WORKDIR /app

# Copy the Vue.js project files
COPY . .

# Install dependencies
RUN npm install

# Build the Vue.js app
RUN npm run build

# Stage 2: Serve the Vue.js app using Nginx
FROM nginx:alpine

# Copy the build output to the Nginx directory
COPY --from=build /app/dist /usr/share/nginx/html

# Expose port 80 for Nginx
EXPOSE 80

# Start Nginx server
CMD ["nginx", "-g", "daemon off;"]
