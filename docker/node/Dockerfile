# Set the base image
FROM node:23.4

ARG APP_ENV

ENV APP_ENV=${APP_ENV:-development}

# Set working directory
WORKDIR /var/www

# Copy `package.json` and `package-lock.json`
COPY package*.json ./

# Install project dependencies
RUN npm install

# Copy project files into the docker image
COPY . .

# Expose the port Vite runs on
EXPOSE 3000

# Start the Vite server or build
ENTRYPOINT ["/bin/sh", "-c"]
CMD ["[ \"$APP_ENV\" = \"production\" ] && npm run build || npm run dev"]

