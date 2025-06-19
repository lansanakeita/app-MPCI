import Link from "next/link";
import {
  EnvironmentOutlined,
  TeamOutlined,
  MailOutlined,
  PhoneOutlined,
  GlobalOutlined,
  FacebookFilled,
} from "@ant-design/icons";

export default function Footer() {
    return (
        <footer className="bg-ministere-blue text-white px-6 pt-8 pb-12">
            <div className="relative z-10 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <h3 className="text-lg font-semibold mb-2 flex items-center space-x-2">
                        <EnvironmentOutlined />
                        <span>Adresse</span>
                    </h3>
                    <p>
                        Immeuble MPCI,
                        <br />
                        Place de la Nation, Boulbinet,
                        <br />
                        C/Kaloum, Conakry, Guinée
                    </p>
                </div>

                <div>
                    <h3 className="text-lg font-semibold mb-2 flex items-center space-x-2">
                        <TeamOutlined />
                        <span>Contacts</span>
                    </h3>
                    <p className="flex items-center space-x-2">
                        <MailOutlined />
                        <a href="mailto:jpciguinee@mpci.gov.gn" className="hover:text-gray-300">
                            jpciguinee@mpci.gov.gn
                        </a>
                    </p>

                    <p className="flex items-center space-x-2 mt-1">
                        <PhoneOutlined />
                        <a href="tel:+224612363636" className="hover:text-gray-300">
                            +224 612 36 36 36
                        </a>
                    </p>
                </div>

                <div>

                    <h3 className="text-lg font-semibold mb-2 flex items-center space-x-2">
                        <GlobalOutlined />
                        <span>Réseaux sociaux</span>
                    </h3>

                    {/* LinkedIn */}
                    <a
                        href="https://www.linkedin.com/company/minist%C3%A8re-du-plan-et-de-la-coop%C3%A9ration-internationale/"
                        target="_blank"
                        rel="noopener noreferrer"
                        className="flex items-center hover:text-gray-300 space-x-2"
                    >
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        className="text-white"
                        viewBox="0 0 24 24"
                        >
                        <path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM0 8h5v16H0V8zm7.5 0H13v2.34h.09c.79-1.48 2.71-3.04 5.58-3.04 5.97 0 7.07 3.1 7.07 7.13V24h-5V15.26c0-2.08-.04-4.76-2.9-4.76-2.9 0-3.35 2.27-3.35 4.62V24h-5V8z" />
                        </svg>
                        <span>LinkedIn</span>
                    </a>

                    {/* Facebook */}
                    <a
                        href="https://www.facebook.com/MPCIGN"
                        target="_blank"
                        rel="noopener noreferrer"
                        className="flex items-center hover:text-gray-300 space-x-2 mt-2"
                    >
                        <FacebookFilled className="text-xl text-white" />
                        <span>Facebook</span>
                    </a>

                    {/* Twitter (X) */}
                        <a
                            href="https://x.com/mpcigov?s=11&t=Hlzs3K1ddqTrN3g9BiVFNw"
                            target="_blank"
                            rel="noopener noreferrer"
                            className="flex items-center hover:text-gray-300 space-x-2 mt-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                className="text-white"
                            >
                            <path d="M20.998 3h-2.65L13.6 9.527 7.9 3H2.002l7.68 8.354L2 21h2.65l5.17-6.163L16.1 21h5.897l-8.11-8.818L20.998 3z" />
                            </svg>
                            <span>Twitter</span>
                        </a>
                    </div>

                </div>

            <div className="relative z-10 mt-8 text-center text-sm border-t border-white/20 pt-4">
                <span className="block md:inline">
                © 2025 MPCI | Tous droits réservés. Développé par
                </span>
                <Link
                href="https://www.linkedin.com/in/lansana-keita-3b670018b"
                target="_blank"
                rel="noopener noreferrer"
                className="block md:inline text-green-300 font-bold underline hover:text-yellow-300 transition"
                >
                Lansana KEITA
                </Link>
            </div>
            
        </footer>
    );
}
