# Use Node 20 base image (ARM-compatible)
FROM node:20

# Set working directory
WORKDIR /app

# Copy package files first (for caching)
COPY package.json pnpm-lock.yaml* ./

# Set env variable to ignore Rollup ARM binary issues
ENV ROLLUP_IGNORE_PLATFORM_CHECK=true

# Install dependencies (pnpm)
RUN npm install -g pnpm
RUN pnpm install --shamefully-hoist

# Copy app source code
COPY . .

# Expose port for Vite
EXPOSE 5173

# Start the dev server
CMD ["pnpm", "run", "dev", "--", "--host", "0.0.0.0"]