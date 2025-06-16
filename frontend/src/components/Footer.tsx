// src/components/Footer.tsx
import Image from 'next/image';

export default function Footer() {
    return (
        <footer className="bg-ministere-blue text-white px-6 pt-12 pb-25">

            <div className="relative z-10 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <h3 className="text-lg font-semibold mb-2">Adresse</h3>
                    <p>
                        Immeuble MPCI,<br />
                        Place de la Nation, Boulbinet,<br />
                        C/Kaloum, Conakry, Guinée
                    </p>
                </div>

                <div>
                    <h3 className="text-lg font-semibold mb-2">Contacts</h3>
                    <p>contact@mpci.gov.gn</p>
                    <p>+224 664 000 000</p>
                    <p>+224 629 000 000</p>
                </div>

                <div className="flex items-center space-x-4">
                    <a href="#" className="hover:text-gray-300">Twitter</a>
                    <a href="#" className="hover:text-gray-300">Facebook</a>
                </div>
            </div>

            <div className="relative z-10 mt-8 text-center text-sm border-t border-white/20 pt-4">
                © 2025 MPCI | Tous droits réservés.  Développé par <span className="text-pink-500 font-bold">Lansana KEITA</span>
            </div>
        </footer>
    );
}