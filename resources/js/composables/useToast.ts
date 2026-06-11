import toast from "izitoast";
import 'izitoast/dist/css/iziToast.min.css'

const useToast = () => ({
    success:({ title, message }: any) => {
        toast.success({
            title: title,
            message: message,
            timeout: 5000,
            position:'bottomRight'
        })
    },
    error:({ title, message }: any) => {
        toast.error({
            title: title,
            message: message,
            timeout: 5000,
            position:'topRight'
        })
    },
    warning:({ title, message }: any) => {
        toast.error({
            title: title,
            message: message,
            timeout: 5000,
            position:'topLeft'
        })
    },
    info:({ title, message }: any) => {
        toast.error({
            title: title,
            message: message,
            timeout: 5000,
            position:'bottomLeft'
        })
    },
    question:({ buttons, onClosing, onClosed }: any) => {
        toast.question({
            close: true,
            timeout: 9000000,
            overlay: true,
            displayMode: 1,
            id: 'question',
            zindex: 999,
            message: `آیم حذف شود?`,
            position: 'center',
            buttons: buttons,
            onClosing: onClosing,
            onClosed: onClosed
        })
    }
})
export default useToast