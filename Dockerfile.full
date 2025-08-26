
# Start with PHP + Apache (or CLI/FPM depending on your app)
FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    python3 python3-pip \
    ffmpeg \
    git \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install Python deps
RUN pip3 install --no-cache-dir --break-system-packages \
    openai-whisper \
    setuptools-rust

# Set working directory
WORKDIR /var/www/html

# Copy your PHP app
COPY . .

# Default command for PHP CLI (can be apache2-foreground if using Apache)
CMD ["bash"]
# CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
