import { object, string } from "yup";
export const AddressSchema = object().shape({
    first_line_address: string().required(),
    second_line_address: string().required(),
    city: string().required(),
    state: string().required(),
    postcode: string().required(),
    country: string().required(),
    phone: string().required(),
});
