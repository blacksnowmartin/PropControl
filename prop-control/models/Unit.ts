import mongoose from 'mongoose'

const UnitSchema = new mongoose.Schema({
  unitNumber: { type: String, required: true },
  property: { type: mongoose.Schema.Types.ObjectId, ref: 'Property', required: true },
  tenant: { type: mongoose.Schema.Types.ObjectId, ref: 'Tenant' },
  rentAmount: { type: Number, required: true },
})

export default mongoose.models.Unit || mongoose.model('Unit', UnitSchema)

