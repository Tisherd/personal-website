FROM node:23.4 as base

WORKDIR /var/www

COPY package*.json ./

RUN npm install

COPY . .

# -------------------------------------
FROM base AS local

EXPOSE 3000
CMD ["npm", "run", "dev"]

# -------------------------------------
FROM base AS production

RUN npm run build
CMD ["echo", "Build complete. Exiting."]
