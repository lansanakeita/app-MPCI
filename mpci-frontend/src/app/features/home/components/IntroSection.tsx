import Image from "next/image";
import { EvenementDTO } from "../../evenements/types";

interface IntroSectionProps {
  evenement?: EvenementDTO;
}

// Formatage 
const getYouTubeEmbedUrl = (url?: string | null): string | undefined => {
if (!url) return undefined;
const match = url.match(/(?:\?v=|\/embed\/|\.be\/)([^&\n?#]+)/);
return match ? `https://www.youtube.com/embed/${match[1]}?playsinline=1` : undefined;
};
  
export default function IntroSection({ evenement }: IntroSectionProps) {
    const embedUrl = getYouTubeEmbedUrl(evenement?.lienVideo);

    return (
        <>


            <div className="relative w-full max-w-6xl h-[200px] sm:h-[300px] md:h-[400px] lg:h-[500px] xl:h-[600px] mx-auto px-2 py-2 mt-2">
                <Image
                    src="/header.jpeg"
                    alt="Bannière de l'événement"
                    fill
                    className="object-cover object-top rounded-md"

                    priority
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
                <section className="w-full px-4 py-6">
                    <div className="max-w-2xl mx-auto aspect-video rounded-md overflow-hidden shadow-lg">
                        <iframe
                            className="w-full h-full"
                            src={embedUrl}
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