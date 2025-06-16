import Link from 'next/link';
import EvenementSection from '../features/evenements/components/EvenementSection';


export default function EvenementsPage() {
    return (
        <main className="max-w-5xl mx-auto px-4 py-10 space-y-4">
            <Link href="/" className="inline-flex items-center text-link hover:underline text-sm font-medium">
                ← Retour à l'accueil
            </Link>
    
            <h1 className="text-2xl font-bold text-link">
                Liste des événements
            </h1>
            <EvenementSection />
        </main>
    );
}