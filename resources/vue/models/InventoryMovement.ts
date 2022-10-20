interface InventoryMovement {
    id: number;
    quantity: number;
    unitPrice: number;
    totalPrice: number;
    remainingQuantity: number;
    createdAt: string;
}

export default InventoryMovement;
