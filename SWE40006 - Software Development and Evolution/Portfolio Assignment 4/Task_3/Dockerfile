FROM python:3.8-slim

WORKDIR /app

# Copy requirements.txt and install dependencies
COPY requirement.txt .
RUN pip install --no-cache-dir -r requirement.txt

# Copy the application code
COPY app.py .

EXPOSE 5000
CMD ["python", "app.py"]
