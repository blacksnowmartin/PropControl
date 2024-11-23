import mongoose from 'mongoose'

const TenantSchema = new mongoose.Schema({
  name: { type: String, required: true },
  idNumber: { type: String, required: true, unique: true },
  phoneNumber: { type: String, required: true },
  unit: { type: mongoose.Schema.Types.ObjectId, ref: 'Unit' },
})

export default mongoose.models.Tenant || mongoose.model('Tenant', TenantSchema)

