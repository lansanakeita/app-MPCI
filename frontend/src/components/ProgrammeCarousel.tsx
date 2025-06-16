'use client';

import { Carousel } from 'antd';
import Image from 'next/image';
import { useRef } from 'react';
import type { CarouselRef } from 'antd/es/carousel';

interface ProgrammeCarouselProps {
  images: string[];
}

export default function ProgrammeCarousel({ images }: ProgrammeCarouselProps) {
  const carouselRef = useRef<CarouselRef>(null);

   if (images.length === 0) return null;

  return (
    <div className="w-full max-w-6xl mx-auto bg-white rounded shadow p-6">
        <h2 className="text-2xl font-bold text-center">Programme</h2>
        {/* <Carousel
            ref={carouselRef}
            dots={false}
            arrows={false}
            autoplay
            autoplaySpeed={2000}
        >
            {images.map((src, index) => (
                <div
                    key={index}

                    className="flex justify-center items-center bg-white min-h-[500px] max-h-screen overflow-auto"

                >
                    <div className="relative w-auto max-h-[800px] max-w-full">
                        <Image
                            src={src}
                            alt={`programme-${index}`}
                            unoptimized
                            width={500}
                            height={600}
                            sizes="100vw"
                            className="w-auto h-auto object-contain mx-auto"
                        />
                    </div>
                </div>
            ))}
        </Carousel> */}

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
        <button
          onClick={() => carouselRef.current?.prev()}
          className="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded"
        >
          Précédent
        </button>
        <button
          onClick={() => carouselRef.current?.next()}
          className="px-4 py-2 bg-ministere-blue-hover text-white rounded"
        >
          Suivant
        </button>
    </div>


    </div>
  );
}
