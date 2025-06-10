import axios from 'axios';
export const API_URL = import.meta.env.VITE_API_URL;


export async function getMaps(tahun = '') {
    return axios.get(`${API_URL}/data-penduduk`)
        .then(response => response.data)
        .catch(error => {
        console.error('Error fetching maps:', error);
        throw error;
        });
}

export async function getKecamatan(){
    return axios.get(`${API_URL}/data-kecamatan`).then(response => response.data)
    .catch(error => {
        console.error('Error fetching kecamatan:', error);
        throw error;
    });
}

export async function getDetailKecamatan(id){
    try{
        const response = await axios.get(`${API_URL}/kecamatan/` + id);
        return response.data;
    }catch(err){
        console.error('Error fetching detail kecamatan:', err);
    }
}
