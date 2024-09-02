PImage img;
float amplitude = 4.0;
float period = 8.0;
float step = 8.0;
float pMin = 1;
float pMax = 5.0;

void settings() {
  size(int(args[2]),int(args[3]));
}

void setup() {
	// size(int(args[2]),int(args[3]));
	String SOURCE = args[0];
	int WIDTH = int(args[2]);
	int HEIGHT = int(args[3]);

	img = loadImage(SOURCE);
	img.resize(WIDTH,0);

	background(0);
	fill(255);
	noStroke();
	noLoop();
}

void draw() {
	for (int x = 0; x < width; x += 1) {
		for (float y = - amplitude; y < height + amplitude*2; y += step) {
			float px = x;
			float py = y + sin(x/period) * amplitude;
			float value = getAverageValue(img, round(px), round(py), round(pMax))/255; // 0 -> 1
			float pr = max(pMax - (value * pMax), pMin);
			circle(px,py,pr);
		}
	}

	String TARGET = args[1];
	save(TARGET);
	exit(); 
}

float getAverageValue(PImage img, int x, int y, int r) {
	int count = 0;
	float value = 0;
	for (int i = x-r; i < x+r; i++) {
		for (int j = y-r; j < y+r; j++) {
			if (i < 0 || i >= width || j < 0 || j >= height) {
				continue;
			}
			color c = img.get(i,j);
			value += brightness(c);
			count++;
		}
	}
	return value/count;
}