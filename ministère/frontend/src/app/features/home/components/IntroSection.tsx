import { EvenementDTO } from '../../evenements/types';
import Image from "next/image";

interface IntroSectionProps {
    evenement?: EvenementDTO;
}

export default function HeroSection({ evenement }: IntroSectionProps) {

    return (
        <div className="max-w-6xl mx-auto mt-4">
            <img 
                src="/header.jpeg" 
                alt="Bannière de l'événement"
                className="w-full h-[300px] object-cover rounded-md shadow"

            />
        </div>
    );
}
