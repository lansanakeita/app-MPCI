// components/ParticipationModal.tsx
import { Modal, Form, Input, message } from "antd";
import { useState } from "react";

type Props = {
    visible: boolean;
    onClose: () => void;
    eventId: string;
};

export default function ParticipationModal({ visible, onClose, eventId }: Props) {
    const [form] = Form.useForm();

    const handleOk = () => {
        form.validateFields()
            .then((values) => {
                // Exemple de traitement
                console.log("Participation submitted:", { ...values, eventId });
                message.success("Participation enregistrée !");
                form.resetFields();
                onClose();
            })
            .catch(() => {
                message.error("Veuillez remplir tous les champs correctement.");
            });
    };

    return (
        <Modal
            title="Event Participation"
            open={visible}
            onOk={handleOk}
            onCancel={onClose}
            okText="Submit"
            cancelText="Cancel"
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
            </Form>
        </Modal>
    );
}
