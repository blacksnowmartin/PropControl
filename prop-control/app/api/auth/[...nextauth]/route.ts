import NextAuth from 'next-auth'
import CredentialsProvider from 'next-auth/providers/credentials'
import { compare } from 'bcryptjs'
import clientPromise from '@/lib/mongodb'

export const authOptions = {
  providers: [
    CredentialsProvider({
      name: 'Credentials',
      credentials: {
        username: { label: "Username", type: "text" },
        password: { label: "Password", type: "password" }
      },
      async authorize(credentials) {
        if (!credentials?.username || !credentials?.password) {
          return null
        }

        const client = await clientPromise
        const usersCollection = client.db().collection('users')
        const user = await usersCollection.findOne({ username: credentials.username })

        if (!user) {
          return null
        }

        const isPasswordCorrect = await compare(credentials.password, user.password)

        if (!isPasswordCorrect) {
          return null
        }

        return { id: user._id, name: user.username, email: user.email }
      }
    })
  ],
  session: {
    strategy: 'jwt'
  },
  pages: {
    signIn: '/login',
  },
}

const handler = NextAuth(authOptions)

export { handler as GET, handler as POST }

//find out how this functionality works
