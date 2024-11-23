import mongoose from 'mongoose'

const PropertySchema = new mongoose.Schema({
  name: { type: String, required: true },
  address: { type: String, required: true },
  units: [{ type: mongoose.Schema.Types.ObjectId, ref: 'Unit' }],
})

export default mongoose.models.Property || mongoose.model('Property', PropertySchema)

