// components/ParticipationModal.tsx

import { useState } from "react";
import { Modal, Form, Input, message } from "antd";
import apiFetch from "@/lib/api";

type Props = {
    visible: boolean;
    onClose: () => void;
    eventId: string;
};

export default function ParticipationModal({ visible, onClose, eventId }: Props) {
    const [form] = Form.useForm();
    const [loading, setLoading] = useState(false);

    const handleOk = async () => {
        try {
            const values = await form.validateFields();
            setLoading(true);

            const payload = { ...values, evenement: eventId };

            await apiFetch("/evenement/inscription", {
                method: "POST",
                body: JSON.stringify(payload),
            });

            message.success("Participation enregistrée !");
            form.resetFields();
            onClose();
        } catch (error) {
            message.error("Une erreur est survenue. Veuillez réessayer.");
        } finally {
            setLoading(false);
        }
    };

    return (
        <Modal
            title="Event Participation"
            open={visible}
            // onOk={handleOk}
            onCancel={onClose}
            footer={null}
            // okText="Submit"
            // cancelText="Cancel"
        >
            <Form form={form} layout="vertical">
                <Form.Item
                    label="Nom de famille"
                    name="nom"
                    rules={[{ required: true, message: "Obligatoire" }]}
                >
                    <Input />
                </Form.Item>
                <Form.Item
                    label="Prénom"
                    name="prenom"
                    rules={[{ required: true, message: "Obligatoire" }]}
                >
                    <Input />
                </Form.Item>
                <Form.Item
                    label="Email"
                    name="email"
                    rules={[
                        { required: true, message: "Obligatoire" },
                        { type: "email", message: " Email invalide" },
                    ]}
                >
                    <Input />
                </Form.Item>         

                <div className="flex justify-end gap-4">
                    <div
                        onClick={() => onClose()}
                        className="bg-ministere-blue-hover text-white py-2 px-4 rounded text-sm cursor-pointer inline-block"
                        >
                        Fermer
                    </div>

                    <div
                        onClick={() => handleOk()}
                        className="bg-ministere-blue-hover text-white py-2 px-4 rounded text-sm cursor-pointer inline-block"
                        >
                        Valider
                    </div>
                </div>                  
            </Form>
        </Modal>
    );
}