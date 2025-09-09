# Step 1: build con Node
FROM node:18 AS build
WORKDIR /app
COPY . .
RUN npm install
RUN npm run build

# Step 2: serve statico con Nginx
FROM nginx:stable-alpine
COPY --from=build /app/dist /usr/share/nginx/html

# Espone la porta
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
