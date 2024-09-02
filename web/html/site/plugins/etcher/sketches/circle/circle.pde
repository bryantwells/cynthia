PImage img;
float step = 8;
float pMin = 1;
float pMax = 5.0;

void settings() {
  size(int(args[2]),int(args[3]));
}

void setup() {
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

	for (int r = 0; r < width; r += step) {
		int stops = r * 4;
		for (float theta = 0; theta < TWO_PI; theta += TWO_PI/stops) {
			float px = width/2 + (r * cos(theta));
			float py = height/2 + (r * sin(theta));
			float value = getAverageValue(img, round(px), round(py), round(pMax))/255;
			float pr = pMax - (value * pMax) + pMin;
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