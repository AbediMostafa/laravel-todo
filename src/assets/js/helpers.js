const handleErrorValidation = (error) => {
    const data = error.response.data;
    const status = error.response.status;
    let errors = '';

    if (status === 422) {
        for (const key in data.errors) {
            errors += `<br> ${data.errors[key].join('<br>')}`;
        }
    ElementPlus.ElMessageBox.alert(
        errors,
        data.message,
        {
            dangerouslyUseHTMLString: true,
            type: 'error',
        }
    )
    }

}
const apiCheck = (error) => {
    if (error.response.status === 401) {
        ElementPlus.ElMessageBox.alert(
            'You dont have permission to view this page',
            'Error',
            {
                dangerouslyUseHTMLString: true,
                type: 'error',
            }
        )
    }
}
const parseResponse = (response) => {
    if (response.data.status) {
        ElementPlus.ElNotification({
            title: 'Success',
            message: response.data.msg,
            type: 'success',
        })
    } else {
        ElementPlus.ElNotification({
            title: 'Error',
            message: response.data.msg,
            type: 'error',
        })
    }
}
const handleLogin = (response) => {
    if (response.data.status) {
        localStorage.setItem('apiKey', response.data.token);
        localStorage.setItem('userName', response.data.userName);

        setTimeout(() => {
            window.location.href = '/tasks';
        }, 500)
    }
}
const initializeAxios = () => {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('apiKey');
}

initializeAxios();
