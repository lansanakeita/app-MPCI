'use client';

import { Carousel } from 'antd';
import Image from 'next/image';
import { useRef } from 'react';
import type { CarouselRef } from 'antd/es/carousel';
import Button from './Button';

interface ProgrammeCarouselProps {
  images: string[];
}

export default function ProgrammeCarousel({ images }: ProgrammeCarouselProps) {
  const carouselRef = useRef<CarouselRef>(null);

   if (images.length === 0) return null;

  return (
    <div className="w-full max-w-6xl mx-auto bg-white rounded shadow p-6">
        <h2 className="text-2xl font-bold text-center">Programme</h2>

        <Carousel
            ref={carouselRef}
            dots={false}
            arrows={false}
            autoplay
            autoplaySpeed={2000}
        >
            {images.map((src, index) => (
                <div
                    key={index}
                    className="flex justify-center items-center bg-white py-8"
                >
                    <Image
                        src={src}
                        alt={`programme-${index}`}
                        unoptimized
                        width={0}
                        height={0}
                        sizes="100vw"
                        priority={index === 0}
                        className="w-auto h-auto object-contain mx-auto"
                    />
                </div>
            ))}
        </Carousel>

      <div className="flex justify-center mt-6 gap-6">

        <Button variant="primary" onClick={() => carouselRef.current?.prev()}>Précédent</Button>

        <Button variant="primary" onClick={() => carouselRef.current?.next()}>Suivant</Button>
      </div>
    </div>
  );
}
