export interface Organization {
    id: number;
    name: string;
}
  
export interface User {
    id: number;
    name?: string;
    email: string;
    role: "admin" | "accountant";
    organization: Organization;
}

export interface Vendor {
    id: number;
    name: string;
    organization_id: number;
}

export interface Invoice {
    id: number;
    organization_id: number;
    vendor_id: number | null;
    amount: number;
    status: "draft" | "paid" | "overdue";
    created_at: string;
    updated_at: string;
}
  