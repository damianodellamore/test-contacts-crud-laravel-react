import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE,
});

export const getContacts = () => api.get('/contacts');
export const getContact = (id) => api.get(`/contacts/${id}`);
export const createContact = (contact) => api.post('/contacts', contact);
export const updateContact = (id, contact) => api.put(`/contacts/${id}`, contact);
export const deleteContact = (id) => api.delete(`/contacts/${id}`);
