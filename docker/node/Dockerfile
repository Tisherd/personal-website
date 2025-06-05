FROM node:23.4 AS base

WORKDIR /var/www/personal-site

COPY package*.json ./

RUN npm install

COPY . .

# -------------------------------------
FROM base AS dev

EXPOSE 3000
CMD ["npm", "run", "dev"]

# -------------------------------------
FROM base AS prod

CMD ["/bin/bash", "-c", "while true; do sleep 1; done"]
