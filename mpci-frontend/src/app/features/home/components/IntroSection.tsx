import Image from "next/image";
import { EvenementDTO } from "../../evenements/types"; 

interface IntroSectionProps {
  evenement?: EvenementDTO;
}

export default function IntroSection({ evenement }: IntroSectionProps) {
    return (
        <>
            <div className="max-w-6xl mx-auto mt-2">
                <Image
                    src="/header.jpeg" 
                    alt="Bannière de l'événement"
                    className="w-full h-[600px] object-cover rounded-md shadow"
                    width={600}
                    height={600}
                />
            </div>

            <h1 className="max-w-6xl mx-auto px-4 mt-6 text-3xl font-bold text-link">
                {evenement?.titre}
            </h1>

            <section className="max-w-6xl mx-auto px-4 py-4 text-left">
                {evenement?.description && (
                    <div
                        className="text-justify"
                        dangerouslySetInnerHTML={{ __html: evenement.description }}
                    />
                )}
            </section>
            {evenement?.lienVideo && (
                <section className="mx-auto px-4 py-6">
                    <div className="aspect-video rounded-md overflow-hidden shadow-lg">
                    <iframe
                        className="w-full h-full"
                        src={evenement.lienVideo} 
                        title="Vidéo de l'événement"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowFullScreen
                    ></iframe>
                    </div>
                </section>
            )}
        </>
    );
}