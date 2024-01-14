export async function request (path, config) {
    return await fetch(path, config)
        .then(response => response.json())
        .then(response => {
            if(response?.status === 'success') {
                return response.data;
            }

            throw new Error(response.data)
        })

}
