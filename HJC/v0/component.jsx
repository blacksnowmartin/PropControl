/**
 * v0 by Vercel.
 * @see https://v0.dev/t/gXSKmeFlIq2
 * Documentation: https://v0.dev/docs#integrating-generated-code-into-your-nextjs-app
 */
import Link from "next/link"
import { Label } from "@/components/ui/label"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"

export default function Component() {
  return (
    <div className="flex flex-col min-h-screen">
      <header className="bg-gray-900 text-white py-4 px-6 md:px-8">
        <div className="container mx-auto flex items-center justify-between">
          <Link href="#" className="flex items-center gap-2" prefetch={false}>
            <MountainIcon className="h-6 w-6" />
            <span className="text-lg font-semibold">Acme Rentals</span>
          </Link>
          <nav className="hidden md:flex items-center gap-4">
            <Link href="#" className="hover:underline" prefetch={false}>
              About
            </Link>
            <Link href="#" className="hover:underline" prefetch={false}>
              Properties
            </Link>
            <Link href="#" className="hover:underline" prefetch={false}>
              Contact
            </Link>
          </nav>
        </div>
      </header>
      <main className="flex-1 bg-gray-100 dark:bg-gray-800 py-12 px-6 md:px-8">
        <div className="container mx-auto max-w-xl">
          <div className="bg-white dark:bg-gray-950 rounded-lg shadow-md p-8">
            <h1 className="text-2xl font-bold mb-4">Pay Your Rent</h1>
            <p className="text-gray-500 dark:text-gray-400 mb-6">
              Use the form below to pay your rent via Mpesa STK push.
            </p>
            <form className="grid gap-4">
              <div>
                <Label htmlFor="name">Name</Label>
                <Input id="name" type="text" placeholder="Enter your name" />
              </div>
              <div>
                <Label htmlFor="phone">Phone Number</Label>
                <Input id="phone" type="tel" placeholder="Enter your phone number" />
              </div>
              <div>
                <Label htmlFor="amount">Rental Amount</Label>
                <Input id="amount" type="number" placeholder="Enter the rental amount" />
              </div>
              <Button
                type="submit"
                className="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-6 rounded-md"
              >
                Pay with Mpesa
              </Button>
            </form>
          </div>
        </div>
      </main>
      <footer className="bg-gray-900 text-white py-6 px-6 md:px-8">
        <div className="container mx-auto flex items-center justify-between">
          <p className="text-sm">&copy; 2024 Acrossnow Rentals</p>
          <nav className="flex items-center gap-4">
            <Link href="#" className="hover:underline" prefetch={false}>
              Privacy
            </Link>
            <Link href="#" className="hover:underline" prefetch={false}>
              Terms
            </Link>
            <Link href="#" className="hover:underline" prefetch={false}>
              Help
            </Link>
          </nav>
        </div>
      </footer>
    </div>
  )
}

function MountainIcon(props) {
  return (
    <svg
      {...props}
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
    >
      <path d="m8 3 4 8 5-5 5 15H2L8 3z" />
    </svg>
  )
}