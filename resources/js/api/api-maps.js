import axios from 'axios';
const api = `https://gis-pemetaan-penduduk-production-fa51.up.railway.app/data`;

export async function getMaps(tahun = '') {
    console.log("app url: ",api)

    return axios.get(`${api}/data-penduduk`)
        .then(response => response.data)
        .catch(error => {
        console.error('Error fetching maps:', error);
        throw error;
        });
}

export async function getKecamatan(){
    return axios.get(`${api}/data-kecamatan`).then(response => response.data)
    .catch(error => {
        console.error('Error fetching kecamatan:', error);
        throw error;
    });
}

export async function getDetailKecamatan(id){
    try{
        const response = await axios.get(`${api}/kecamatan/` + id);
        return response.data;
    }catch(err){
        console.error('Error fetching detail kecamatan:', err);
    }
}
