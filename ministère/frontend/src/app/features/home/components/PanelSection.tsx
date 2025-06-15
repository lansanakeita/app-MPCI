import SpeakerCard from "@/components/SpeakerCard"
import Link from "next/link";

type PanelSectionProps = {
    panelists: {
        id: string;
        name: string;
        title: string;
        photoUrl?: string;
    }[]
}

const PanelSection = ({ panelists }: PanelSectionProps) => {
    return (
        <div className="p-6">
            <div className="max-w-7xl mx-auto px-4">
                <h2 className="text-2xl font-bold mb-4">Panelists</h2>

                <div className="grid gap-6 justify-items-center
                    grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                    {panelists.map((person) => (
                        <Link href={`/invite/${person.id}`} key={person.id} className="w-full">
                        <SpeakerCard
                          name={person.name}
                          title={person.title}
                          photoUrl={person.photoUrl}
                        />
                      </Link>
                        // <SpeakerCard
                        //     key={person.id}
                        //     name={person.name}
                        //     title={person.title}
                        //     photoUrl={person.photoUrl}
                        // />
                    ))}
                </div>
            </div>
        </div>
    )
}
  
export default PanelSection