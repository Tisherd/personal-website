FROM node:23.4 AS base

WORKDIR /var/www

COPY package*.json ./

RUN npm install

COPY . .

# -------------------------------------
FROM base AS dev

EXPOSE 3000
CMD ["npm", "run", "dev"]

# -------------------------------------
FROM base AS prod

RUN npm run build
CMD ["echo", "Build complete. Exiting."]
