import Image from 'next/image';
export default function HeroSection() {

    return (
        <div className="max-w-6xl mx-auto mt-4">
            <Image 
                src="/header.jpeg" 
                alt="Bannière de l'événement"
                className="w-full h-[300px] object-cover rounded-md shadow"
            />
        </div>
    );
}
