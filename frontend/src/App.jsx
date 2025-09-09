import { useEffect, useState } from "react";
import { getContacts, createContact, updateContact, deleteContact } from "./api";
import "./App.css";

function App() {
  const [contacts, setContacts] = useState([]);
  const [form, setForm] = useState({ first_name: "", last_name: "", email: "" });
  const [editingId, setEditingId] = useState(null);

  const loadContacts = async () => {
    const { data } = await getContacts();
    setContacts(data);
  };

  useEffect(() => {
    loadContacts();
  }, []);

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (editingId) {
      await updateContact(editingId, form);
    } else {
      await createContact(form);
    }
    setForm({ first_name: "", last_name: "", email: "" });
    setEditingId(null);
    loadContacts();
  };

  const handleEdit = (contact) => {
    setForm(contact);
    setEditingId(contact.id);
  };

  const handleDelete = async (id) => {
    await deleteContact(id);
    loadContacts();
  };

  return (
    <div className="app-container">
      <h1>📒 Gestione Contatti</h1>

      <form className="contact-form" onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Nome"
          value={form.first_name}
          onChange={(e) => setForm({ ...form, first_name: e.target.value })}
          required
        />
        <input
          type="text"
          placeholder="Cognome"
          value={form.last_name}
          onChange={(e) => setForm({ ...form, last_name: e.target.value })}
          required
        />
        <input
          type="email"
          placeholder="Email"
          value={form.email}
          onChange={(e) => setForm({ ...form, email: e.target.value })}
          required
        />
        <button type="submit">{editingId ? "💾 Aggiorna" : "➕ Aggiungi"}</button>
      </form>

      <table className="contacts-table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Email</th>
            <th>Azioni</th>
          </tr>
        </thead>
        <tbody>
          {contacts.map((c) => (
            <tr key={c.id}>
              <td>{c.first_name}</td>
              <td>{c.last_name}</td>
              <td>{c.email}</td>
              <td>
                <button className="action-btn edit-btn" onClick={() => handleEdit(c)}>
                  ✏️ Modifica
                </button>
                <button className="action-btn delete-btn" onClick={() => handleDelete(c.id)}>
                  🗑️ Elimina
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default App;
