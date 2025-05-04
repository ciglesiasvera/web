const images = document.querySelectorAll('.carousel-image');
const radius = 270;
const progress = {
  value: 0 };

const carousel = document.querySelector('.carousel');

Observer.create({
  target: carousel,
  type: "wheel,pointer",
  onPress: self => {
    carousel.style.cursor = 'grabbing';
  },
  onRelease: self => {
    carousel.style.cursor = 'grab';
  },
  onChange: self => {
    gsap.killTweensOf(progress);
    const p = self.event.type === 'wheel' ? self.deltaY * -.0005 : self.deltaX * .05;
    gsap.to(progress, {
      duration: 2,
      ease: 'power4.out',
      value: `+=${p}` });

  } });


const animate = () => {
  images.forEach((image, index) => {
    const theta = index / images.length - progress.value;
    const x = -Math.sin(theta * Math.PI * 2) * radius;
    const y = Math.cos(theta * Math.PI * 2) * radius;
    image.style.transform = `translate3d(${x}px, 0px, ${y}px) rotateY(${360 * -theta}deg)`;
    const c = Math.floor(index / images.length * 360);
    const hue = 100 + (60 * index / images.length); 
    const lightness = 35 + (30 * index / images.length); 
    image.style.background = `hsla(${hue}, 60%, ${lightness}%, 0.8)`;
  });
};
gsap.ticker.add(animate);

gsap.config({ trialWarn: false });
