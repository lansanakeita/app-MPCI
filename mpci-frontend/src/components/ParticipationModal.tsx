import { Fragment, useState } from "react";
import { Dialog, DialogPanel, DialogTitle, Transition } from '@headlessui/react'
import { useToast } from '@/components/ToastProvider';
import Button from "./Button";
import { submitParticipation } from "@/app/features/evenements/api";

type Props = {
    visible: boolean;
    onClose: () => void;
    eventId: string;
};


export default function ParticipationModal({ visible, onClose, eventId }: Props) {
    const [form, setForm] = useState({ nom: '', prenom: '', email: '' });
    const [errors, setErrors] = useState<{ [key: string]: string }>({});
  
    const validate = () => {
        const newErrors: { [key: string]: string } = {};
        if (!form.nom) newErrors.nom = 'Obligatoire';
        if (!form.prenom) newErrors.prenom = 'Obligatoire';
        if (!form.email) {
            newErrors.email = 'Obligatoire';
        } else if (!/\S+@\S+\.\S+/.test(form.email)) {
            newErrors.email = 'Email invalide';
        }
        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    const toast = useToast();
  
    const handleSubmit = async () => {
        if (!validate()) return;
  
        try {
            const payload = { ...form, evenement: eventId };
            await submitParticipation(payload);
            setForm({ nom: '', prenom: '', email: '' });
            onClose();
            toast({ type: 'success', message: 'Participation enregistrée !' });
        } 
        //eslint-disable-next-line @typescript-eslint/no-explicit-any
        catch (err: any) {
            const status = err?.response?.status;
          
            if (status === 409) {
              toast({ type: 'error', message: 'Vous êtes déjà inscrit à cet événement' });
            } else {
              toast({ type: 'error', message: 'Une erreur est survenue. Veuillez réessayer.' });
            }
        }
    };
  
    return (
        <Transition appear show={visible} as={Fragment}>
            <Dialog as="div" className="relative z-50" onClose={onClose}>
                <div className="fixed inset-0 bg-white bg-opacity-40" />

                <div className="fixed inset-0 overflow-y-auto">
                    <div className="flex min-h-full items-center justify-center p-4">
                        <DialogPanel className="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 shadow-xl transition-all">
                            <DialogTitle className="text-2xl font-semibold text-gray-900 mb-4">
                                Inscription
                            </DialogTitle>

                            {/* Form */}
                            <div className="space-y-4">
                                <div>
                                <label className="block text-sm font-medium text-gray-700">Nom de famille</label>
                                <input
                                    type="text"
                                    value={form.nom}
                                    onChange={(e) => setForm({ ...form, nom: e.target.value })}
                                    className="w-full mt-1 p-2 border border-gray-300 rounded"
                                />
                                {errors.nom && <p className="text-red-500 text-sm">{errors.nom}</p>}
                                </div>

                                <div>
                                <label className="block text-sm font-medium text-gray-700">Prénom</label>
                                <input
                                    type="text"
                                    value={form.prenom}
                                    onChange={(e) => setForm({ ...form, prenom: e.target.value })}
                                    className="w-full mt-1 p-2 border border-gray-300 rounded"
                                />
                                {errors.prenom && <p className="text-red-500 text-sm">{errors.prenom}</p>}
                                </div>

                                <div>
                                <label className="block text-sm font-medium text-gray-700">Email</label>
                                <input
                                    type="email"
                                    value={form.email}
                                    onChange={(e) => setForm({ ...form, email: e.target.value })}
                                    className="w-full mt-1 p-2 border border-gray-300 rounded"
                                />
                                {errors.email && <p className="text-red-500 text-sm">{errors.email}</p>}
                                </div>
                            </div>

                            {/* Footer buttons */}
                            <div className="mt-6 flex justify-end gap-4">
                                <Button variant="secondary" onClick={onClose}>Fermer</Button>

                                <Button variant="primary" onClick={handleSubmit}>Valider</Button>
                            </div>
                        </DialogPanel>
                    </div>
                </div>
            </Dialog>
        </Transition>
    );
}