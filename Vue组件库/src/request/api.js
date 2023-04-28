import instance from "./request";

export const LogoutAPI = () => instance.post("/admin/logout");

export const loginAPI = (data) => instance.post("/admin/login", data);

export const StatusAPI = (data) =>
  instance.post(`/productCategory?ids=${data.id}&navStatus=${data.navStatus}`);

export const FlashSessionListApi = () => instance.get("/flashSession/list");

export const ProductCategoryApi = (params) =>
  instance.get(`/productCategory/list/${params.parentId}`, { params });

export const AdminListAPI = (params) => instance.get("/admin/list", { params });
