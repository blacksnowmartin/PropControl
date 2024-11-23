import mongoose from 'mongoose'

const PaymentSchema = new mongoose.Schema({
  tenant: { type: mongoose.Schema.Types.ObjectId, ref: 'Tenant', required: true },
  unit: { type: mongoose.Schema.Types.ObjectId, ref: 'Unit', required: true },
  amount: { type: Number, required: true },
  paymentDate: { type: Date, default: Date.now },
  mpesaTransactionId: { type: String, required: true, unique: true },
})

export default mongoose.models.Payment || mongoose.model('Payment', PaymentSchema)

