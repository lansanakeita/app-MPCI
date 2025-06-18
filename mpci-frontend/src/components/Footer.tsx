export default function Footer() {
    return (
        <footer className="bg-ministere-blue text-white px-6 pt-8 pb-12">

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
                    <p>+224 612 36 36 36</p>
                </div>

                <div className="flex items-center space-x-4">
                    <a href="#" className="hover:text-gray-300">Twitter</a>
                    <a href="#" className="hover:text-gray-300">Facebook</a>
                </div>
            </div>
            <div className="relative z-10 mt-8 text-center text-sm border-t border-white/20 pt-4">
                <span className="block md:inline">
                    © 2025 MPCI | Tous droits réservés. Développé par
                </span>
                <a
                    href="https://www.linkedin.com/in/lansana-keita-3b670018b"
                    target="_blank"
                    rel="noopener noreferrer"
                    className="block md:inline text-green-300 font-bold underline hover:text-yellow-300 transition"
                >
                    Lansana KEITA
                </a>
            </div>
        </footer>
    );
}